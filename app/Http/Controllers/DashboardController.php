<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Range;
use App\Models\Investment;
use Illuminate\Http\Request;
use App\Services\RangeService;
use App\Services\MinApiService;
use App\Services\ReferalService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
  /**
   * The Min Api service
   * @var App\Services\MinApiService
   */
  protected $minApiService;

  public function __construct(ReferalService $referalService = null, RangeService $rangeService, TreController $tree_controller, MinApiService $minApiService)
  {
    $this->referal = $referalService;
    $this->range = $rangeService;
    $this->tree = $tree_controller;
    $this->minApiService = $minApiService;
  }

  //landing
  public function landing()
  {
    return redirect()->route('welcome');
    // return view('index');
  }

  public function index()
  {
    $pageConfigs = ['pageHeader' => false];
    $month = [
      "",
      "Enero",
      "Febrero",
      "Marzo",
      "Abril",
      "Mayo",
      "Junio",
      "Julio",
      "Agosto",
      "Septiembre",
      "Octubre",
      "Noviembre",
      "Diciembre"
    ];
    $current_month_number = intval(date("m"));
    $current_month = $month[$current_month_number];
    $user = User::findOrFail(Auth::user()->id);


    if ($user->admin == 1) {
      $orders = Order::orderBy('id', 'desc')->get()->take(10);
      return view('dashboard.admin', ['pageConfigs' => $pageConfigs], compact('user', 'orders'));
    } else if ($user->admin == 3 || $user->admin == 2) {
      $formularys = 0;
      return view('/subadmin/package', compact('formularys'), ['pageConfigs' => $pageConfigs]);
    } else {
      $total_referrals = $this->tree->getChildrenCount($user->referidos, 2, 0);
      $indirect_referrals = $total_referrals - $user->referidos->count();
      $investments = Investment::where('user_id', $user->id)->with('licensePackage')->get();
      $total_available = $user->wallets->where('status', 0)->sum('amount');
      $user_packages = $user->getActivePackages();
      $daysRemaining = 0;
      $user->range;
      $rangos = Range::all();
       
       //return $rangos[1][0];
      if($user->investment)
      {
          $date1 = Carbon::parse($user->investment->expiration_date);
          $daysRemaining = $date1->diffInDays(today()->format('Y-m-d') );

      }
      $activeUsers = User::where('status', '1')->count();
      $inactiveUsers = User::where('status', '0')->count();
      $allUsers = User::all()->count();
      //criptobar
      $cryptos = $this->minApiService->get10Cryptos();
      return view('dashboard.user', ['pageConfigs' => $pageConfigs], compact('allUsers','activeUsers','inactiveUsers','rangos','user', 'cryptos', 'investments', 'indirect_referrals', 'total_referrals', 'total_available', 'user_packages'));
    }
  }

  // Dashboard user - para grafico de dias faltantes
  public function getDaysChart($user_id){
    Log::info('ususario '.$user_id);
    $user = User::findOrFail($user_id);
    
    $investments = Investment::where('user_id', $user_id)->with('licensePackage')->get();

    $date2 = Carbon::parse($user->investment->created_at);
    $date1 = Carbon::parse($user->investment->expiration_date);

    $total_days = $date2->diffInDays(today()->format('Y-m-d'));
    $daysRemaining = $date1->diffInDays(today()->format('Y-m-d') ); 
    Log::info($total_days);
    $data = [$total_days, $daysRemaining];

    return $data;
}

public function getDaysChartAxios(){
  $user_id = Auth::user()->id;
  Log::info('ususario '.$user_id);
  $user = User::findOrFail($user_id);
  
  $investments = Investment::where('user_id', $user_id)->with('licensePackage')->get();

  $date2 = Carbon::parse($user->investment->created_at);
  $date1 = Carbon::parse($user->investment->expiration_date);

  $total_days = $date2->diffInDays(today()->format('Y-m-d'));
  $daysRemaining = $date1->diffInDays(today()->format('Y-m-d') ); 
  $data = ['total_days'=>$total_days, 'daysRemaining'=>$daysRemaining];

   return response()->json(['value' =>   $data ]);
}

  // Dashboard - Analyticspwalle
  public function dashboardAnalytics()
  {
    $pageConfigs = ['pageHeader' => false];

    return view('/content/dashboard/dashboard-analytics', ['pageConfigs' => $pageConfigs]);
  }

  // Dashboard - Ecommerce
  public function dashboardEcommerce()
  {
    $pageConfigs = ['pageHeader' => false];

    return view('/content/dashboard/dashboard-ecommerce', ['pageConfigs' => $pageConfigs]);
  }

  public function getRentChart(Request $request)
  {
    $rentability = Investment::where('user_id', $request->userId)->where('status', 1)->first();
    $gained = $rentability->gain;
    if ($rentability->type !== 'Oro') {
      $maxGain = $rentability->invested * 200;
    } else {
      $maxGain = $rentability->invested * 400;
    }
    $data = [$gained, $maxGain];

    return $data;
  }

  public function getDataRangesCharts()
  {
    $data_ranges = $this->range->countUsersByRanges();
    return $data_ranges;
  }
  /*
  * Cambia el modo de la app Light o Dark
  */
  public function changeAppColor(Request $request)
  {
    $request->validate([
      'mode' => 'required'
    ]);
    $user = User::findOrFail(Auth::user()->id);
    $user->update(['app_mode' => $request->mode]);
    return $user;
  }

  public function getDataBarChart()
  {
    $user = Auth::user();
    $direct_childres = User::where('buyer_id', $user->id)->get();
    $referals_childrens = $this->tree->getChildren($direct_childres, 1);
    $crypto = 0;
    $binarias = 0;
    $forex = 0;
    $sinteticos = 0;
    //Nivel 1
    foreach ($referals_childrens as $user) {
      foreach ($user->memberships as $membership) {
        if ($membership->status == 'activo') {
          $type = $membership->ordenes->type;
          if ($type == 'cryptos') {
            $crypto++;
          } elseif ($type == 'irv_indices_sinteticos') {
            $sinteticos++;
          } elseif ($type == 'irv_opciones_binaria') {
            $binarias++;
          } elseif ($type == 'irv_forex') {
            $forex++;
          }
        }
      }
    }
    //Nivel 2
    foreach ($referals_childrens as $user) {
      foreach ($user->children as $user) {
        foreach ($user->memberships as $membership) {
          if ($membership->status == 'activo') {
            $type = $membership->ordenes->type;
            if ($type == 'cryptos') {
              $crypto++;
            } elseif ($type == 'irv_indices_sinteticos') {
              $sinteticos++;
            } elseif ($type == 'irv_opciones_binaria') {
              $binarias++;
            } elseif ($type == 'irv_forex') {
              $forex++;
            }
          }
        }
      }
    }
    //Nivel 3
    foreach ($referals_childrens as $user) {
      foreach ($user->children as $user) {
        foreach ($user->children as $user) {
          foreach ($user->memberships as $membership) {
            if ($membership->status == 'activo') {
              $type = $membership->ordenes->type;
              if ($type == 'cryptos') {
                $crypto++;
              } elseif ($type == 'irv_indices_sinteticos') {
                $sinteticos++;
              } elseif ($type == 'irv_opciones_binaria') {
                $binarias++;
              } elseif ($type == 'irv_forex') {
                $forex++;
              }
            }
          }
        }
      }
    }
    //Nivel 4
    foreach ($referals_childrens as $user) {
      foreach ($user->children as $user) {
        foreach ($user->children as $user) {
          foreach ($user->children as $user) {
            foreach ($user->memberships as $membership) {
              if ($membership->status == 'activo') {
                $type = $membership->ordenes->type;
                if ($type == 'cryptos') {
                  $crypto++;
                } elseif ($type == 'irv_indices_sinteticos') {
                  $sinteticos++;
                } elseif ($type == 'irv_opciones_binaria') {
                  $binarias++;
                } elseif ($type == 'irv_forex') {
                  $forex++;
                }
              }
            }
          }
        }
      }
    }
    //Nivel 5
    foreach ($referals_childrens as $user) {
      foreach ($user->children as $user) {
        foreach ($user->children as $user) {
          foreach ($user->children as $user) {
            foreach ($user->children as $user) {
              foreach ($user->memberships as $membership) {
                if ($membership->status == 'activo') {
                  $type = $membership->ordenes->type;
                  if ($type == 'cryptos') {
                    $crypto++;
                  } elseif ($type == 'irv_indices_sinteticos') {
                    $sinteticos++;
                  } elseif ($type == 'irv_opciones_binaria') {
                    $binarias++;
                  } elseif ($type == 'irv_forex') {
                    $forex++;
                  }
                }
              }
            }
          }
        }
      }
    }
    //Nivel 6
    foreach ($referals_childrens as $user) {
      foreach ($user->children as $user) {
        foreach ($user->children as $user) {
          foreach ($user->children as $user) {
            foreach ($user->children as $user) {
              foreach ($user->children as $user) {
                foreach ($user->memberships as $membership) {
                  if ($membership->status == 'activo') {
                    $type = $membership->ordenes->type;
                    if ($type == 'cryptos') {
                      $crypto++;
                    } elseif ($type == 'irv_indices_sinteticos') {
                      $sinteticos++;
                    } elseif ($type == 'irv_opciones_binaria') {
                      $binarias++;
                    } elseif ($type == 'irv_forex') {
                      $forex++;
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
    //Nivel 7
    foreach ($referals_childrens as $user) {
      foreach ($user->children as $user) {
        foreach ($user->children as $user) {
          foreach ($user->children as $user) {
            foreach ($user->children as $user) {
              foreach ($user->children as $user) {
                foreach ($user->children as $user) {
                  foreach ($user->memberships as $membership) {
                    if ($membership->status == 'activo') {
                      $type = $membership->ordenes->type;
                      if ($type == 'cryptos') {
                        $crypto++;
                      } elseif ($type == 'irv_indices_sinteticos') {
                        $sinteticos++;
                      } elseif ($type == 'irv_opciones_binaria') {
                        $binarias++;
                      } elseif ($type == 'irv_forex') {
                        $forex++;
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
    //Nivel 8
    foreach ($referals_childrens as $user) {
      foreach ($user->children as $user) {
        foreach ($user->children as $user) {
          foreach ($user->children as $user) {
            foreach ($user->children as $user) {
              foreach ($user->children as $user) {
                foreach ($user->children as $user) {
                  foreach ($user->children as $user) {
                    foreach ($user->memberships as $membership) {
                      if ($membership->status == 'activo') {
                        $type = $membership->ordenes->type;
                        if ($type == 'cryptos') {
                          $crypto++;
                        } elseif ($type == 'irv_indices_sinteticos') {
                          $sinteticos++;
                        } elseif ($type == 'irv_opciones_binaria') {
                          $binarias++;
                        } elseif ($type == 'irv_forex') {
                          $forex++;
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
    //Nivel 9
    foreach ($referals_childrens as $user) {
      foreach ($user->children as $user) {
        foreach ($user->children as $user) {
          foreach ($user->children as $user) {
            foreach ($user->children as $user) {
              foreach ($user->children as $user) {
                foreach ($user->children as $user) {
                  foreach ($user->children as $user) {
                    foreach ($user->children as $user) {
                      foreach ($user->memberships as $membership) {
                        if ($membership->status == 'activo') {
                          $type = $membership->ordenes->type;
                          if ($type == 'cryptos') {
                            $crypto++;
                          } elseif ($type == 'irv_indices_sinteticos') {
                            $sinteticos++;
                          } elseif ($type == 'irv_opciones_binaria') {
                            $binarias++;
                          } elseif ($type == 'irv_forex') {
                            $forex++;
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
    //Nivel 10
    foreach ($referals_childrens as $user) {
      foreach ($user->children as $user) {
        foreach ($user->children as $user) {
          foreach ($user->children as $user) {
            foreach ($user->children as $user) {
              foreach ($user->children as $user) {
                foreach ($user->children as $user) {
                  foreach ($user->children as $user) {
                    foreach ($user->children as $user) {
                      foreach ($user->children as $user) {
                        foreach ($user->memberships as $membership) {
                          if ($membership->status == 'activo') {
                            $type = $membership->ordenes->type;
                            if ($type == 'cryptos') {
                              $crypto++;
                            } elseif ($type == 'irv_indices_sinteticos') {
                              $sinteticos++;
                            } elseif ($type == 'irv_opciones_binaria') {
                              $binarias++;
                            } elseif ($type == 'irv_forex') {
                              $forex++;
                            }
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
    //Nivel 11
    foreach ($referals_childrens as $user) {
      foreach ($user->children as $user) {
        foreach ($user->children as $user) {
          foreach ($user->children as $user) {
            foreach ($user->children as $user) {
              foreach ($user->children as $user) {
                foreach ($user->children as $user) {
                  foreach ($user->children as $user) {
                    foreach ($user->children as $user) {
                      foreach ($user->children as $user) {
                        foreach ($user->children as $user) {
                          foreach ($user->memberships as $membership) {
                            if ($membership->status == 'activo') {
                              $type = $membership->ordenes->type;
                              if ($type == 'cryptos') {
                                $crypto++;
                              } elseif ($type == 'irv_indices_sinteticos') {
                                $sinteticos++;
                              } elseif ($type == 'irv_opciones_binaria') {
                                $binarias++;
                              } elseif ($type == 'irv_forex') {
                                $forex++;
                              }
                            }
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
    //Nivel 12
    foreach ($referals_childrens as $user) {
      foreach ($user->children as $user) {
        foreach ($user->children as $user) {
          foreach ($user->children as $user) {
            foreach ($user->children as $user) {
              foreach ($user->children as $user) {
                foreach ($user->children as $user) {
                  foreach ($user->children as $user) {
                    foreach ($user->children as $user) {
                      foreach ($user->children as $user) {
                        foreach ($user->children as $user) {
                          foreach ($user->children as $user) {
                            foreach ($user->memberships as $membership) {
                              if ($membership->status == 'activo') {
                                $type = $membership->ordenes->type;
                                if ($type == 'cryptos') {
                                  $crypto++;
                                } elseif ($type == 'irv_indices_sinteticos') {
                                  $sinteticos++;
                                } elseif ($type == 'irv_opciones_binaria') {
                                  $binarias++;
                                } elseif ($type == 'irv_forex') {
                                  $forex++;
                                }
                              }
                            }
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
    //Nivel 13
    foreach ($referals_childrens as $user) {
      foreach ($user->children as $user) {
        foreach ($user->children as $user) {
          foreach ($user->children as $user) {
            foreach ($user->children as $user) {
              foreach ($user->children as $user) {
                foreach ($user->children as $user) {
                  foreach ($user->children as $user) {
                    foreach ($user->children as $user) {
                      foreach ($user->children as $user) {
                        foreach ($user->children as $user) {
                          foreach ($user->children as $user) {
                            foreach ($user->children as $user) {
                              foreach ($user->memberships as $membership) {
                                if ($membership->status == 'activo') {
                                  $type = $membership->ordenes->type;
                                  if ($type == 'cryptos') {
                                    $crypto++;
                                  } elseif ($type == 'irv_indices_sinteticos') {
                                    $sinteticos++;
                                  } elseif ($type == 'irv_opciones_binaria') {
                                    $binarias++;
                                  } elseif ($type == 'irv_forex') {
                                    $forex++;
                                  }
                                }
                              }
                            }
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
    //Nivel 14
    foreach ($referals_childrens as $user) {
      foreach ($user->children as $user) {
        foreach ($user->children as $user) {
          foreach ($user->children as $user) {
            foreach ($user->children as $user) {
              foreach ($user->children as $user) {
                foreach ($user->children as $user) {
                  foreach ($user->children as $user) {
                    foreach ($user->children as $user) {
                      foreach ($user->children as $user) {
                        foreach ($user->children as $user) {
                          foreach ($user->children as $user) {
                            foreach ($user->children as $user) {
                              foreach ($user->children as $user) {
                                foreach ($user->memberships as $membership) {
                                  if ($membership->status == 'activo') {
                                    $type = $membership->ordenes->type;
                                    if ($type == 'cryptos') {
                                      $crypto++;
                                    } elseif ($type == 'irv_indices_sinteticos') {
                                      $sinteticos++;
                                    } elseif ($type == 'irv_opciones_binaria') {
                                      $binarias++;
                                    } elseif ($type == 'irv_forex') {
                                      $forex++;
                                    }
                                  }
                                }
                              }
                            }
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
    //Nivel 15
    foreach ($referals_childrens as $user) {
      foreach ($user->children as $user) {
        foreach ($user->children as $user) {
          foreach ($user->children as $user) {
            foreach ($user->children as $user) {
              foreach ($user->children as $user) {
                foreach ($user->children as $user) {
                  foreach ($user->children as $user) {
                    foreach ($user->children as $user) {
                      foreach ($user->children as $user) {
                        foreach ($user->children as $user) {
                          foreach ($user->children as $user) {
                            foreach ($user->children as $user) {
                              foreach ($user->children as $user) {
                                foreach ($user->children as $user) {
                                  foreach ($user->memberships as $membership) {
                                    if ($membership->status == 'activo') {
                                      $type = $membership->ordenes->type;
                                      if ($type == 'cryptos') {
                                        $crypto++;
                                      } elseif ($type == 'irv_indices_sinteticos') {
                                        $sinteticos++;
                                      } elseif ($type == 'irv_opciones_binaria') {
                                        $binarias++;
                                      } elseif ($type == 'irv_forex') {
                                        $forex++;
                                      }
                                    }
                                  }
                                }
                              }
                            }
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }

    $data = [
      'crypto' => $crypto,
      'binarias' => $binarias,
      'forex' => $forex,
      'sinteticos' => $sinteticos
    ];
    return $data;
  }
}
