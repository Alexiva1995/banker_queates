<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\Tree;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Level;

class TreController extends Controller
{
    use Tree;
    protected $position;

    public function index()
    {
        $user = Auth::user();
        $direct_childres = User::where('buyer_id', $user->id)->get();
        $referals_childrens =  $this->getChildren($direct_childres, 1);
        $lastLevelActive = Level::where('status', 1)->orderBy('id', 'desc')->first();
        return view('unilevel.index', compact('referals_childrens', 'lastLevelActive'));
       

        // try {
        // /*
        // try {
        //     $base = Auth::user();
        //     $trees = $this->getDataEstructura(Auth::id());
        //     //dd($trees);
        //     $base->logoarbol = asset('img/tree/tree.svg');
        //     return view('genealogy.tree', compact('trees', 'base'));
        // } catch (\Throwable $th) {
        //     Log::error('Tree - index -> Error: '.$th);
        //     abort(500, "Ocurrio un error, contacte con el administrador");
        // }
        // */
        // }
    }
    public function referredTree()
    {
        try {
            $base = Auth::user();
            $trees = $this->getDataEstructura(Auth::id());
            $base->logoarbol = asset('images/avatars/1.png');
            $lastLevelActive = Level::where('status', '1')->orderBy('id', 'desc')->first();
            return view('genealogy.tree', compact('trees', 'base', 'lastLevelActive'));
        } catch (\Throwable $th) {
            Log::error('Tree - index -> Error: ' . $th);
                abort(500, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function buscar()
    {
        return view('genealogy.buscar');
    }
    public function levels()
    {
        $levels = Level::all();
        $lastLevelActive = Level::where('status', '1')->orderBy('id', 'desc')->first();
        return view('levels.index', compact('lastLevelActive', 'levels'));
    }
    public function activateLevels(Request $request)
    {
        $levels = Level::all();
        foreach ($levels as $level) {
            if ( $level->id <= $request->level) {
                $level->status = 1;
                $level->update();
            } else {
                $level->status = 0;
                $level->update();
            }
        }
        return back()->with('success', 'Los niveles han sido actualizados');
    }

    public function search(Request $request)
    {   
        
        $user = User::find($request->id);
        if($user == null) { return back()->with('error', 'Usuario no Encontrado'); }
        
        $direct_childres = User::where('buyer_id', $user->id)->get();
        $referals_childrens = $this->getChildren($direct_childres, 1);
    
        return view('user.admin-referidos', compact('referals_childrens', 'direct_childres', 'user'));

        /*
        try {
            // titulo
            $trees = $this->getDataEstructura($request->id);
            //$type = ucfirst($type);
            $base = User::find($request->id);
            $base->logoarbol = asset('assets/img/sistema/favicon.png');


            return view('genealogy.tree', compact('trees', 'base'));
        } catch (\Throwable $th) {

            return back()->with('danger', 'El ID que ingreso no existe');
        }
        */
    }

    public function moretree($id)
    {
        try {
            // titulo
            $id = base64_decode($id);
            $trees = $this->getDataEstructura($id);
            //$type = ucfirst($type);
            $base = User::find($id);
            $base->logoarbol = asset('assets/img/sistema/favicon.png');

            $type_tm = 0;

            return view('genealogy.tree', compact('trees', 'base'));
        } catch (\Throwable $th) {
            Log::error('Tree - moretree -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    private function getDataEstructura($id)
    {
        try {
          
            $childres = $this->getData($id, 1);
            $trees = $this->getChildren($childres, 2);
            return $trees;
        } catch (\Throwable $th) {
            Log::error('Tree - getDataEstructura -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function getChildren($users, $nivel)
    {
       
        try {
            if (!empty($users)) {
                foreach ($users as $user) {
                    $user->children = $this->getData($user->id, $nivel);

                    $this->getChildren($user->children, ($nivel+1));
                }
                return $users;
            }else{
                return $users;
            }
        } catch (\Throwable $th) {
            Log::error('Tree - getChildren -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     *Cuenta la cantidad de referidos indirectos de un usuario
     *
     * @param Userscollection - Colleccion que contiene a los referidos del usuario
     * @param integer $nivel - nivel en que los referidos se encuentra
     * @param integer $count - Contador
     * @return integer la cantidad de referidos indirectos
     */
    public function getChildrenCount($users, $nivel, $count)
    {
        try {
            if (!empty($users)) 
            {
                foreach ($users as $user) {
                    $user->children = $this->getData($user->id, $nivel);
                    $nivel++;
                    $count++;
                    $count = $this->getChildrenCount($user->children, $nivel, $count);
                }
                return $count;
            }else{
                return $count;
            }
        } catch (\Throwable $th) {
            Log::error('Tree - getChildrenCount or Quantity -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Se trare la informacion de los hijos
     *
     * @param integer $id - id a buscar hijos
     * @param integer $nivel - nivel en que los hijos se encuentra
     * @param string $typeTree - tipo de arbol a usar
     * @return object
     */
    private function getData($id, $nivel)
    {
        try {
            $resul = User::where('buyer_id', $id)->get();
            foreach ($resul as $user) {
                $user->nivel = $nivel;
                $user->logoarbol = asset('assets/img/sistema/favicon.png');
            }
            return $resul;
        } catch (\Throwable $th) {
            Log::error('Tree - getData -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }
    /**
     * Asigna la posición del usuario en caso de no tener un link de referido directo
     */
    public function getPosition(int $id, $L, $lado)
    {
        try {
            Log::debug('Tree - getPosition');
            $resul = 0;
            $ids = $this->getIDs($id, $lado);
            $limiteFila = 2;
            if ($lado != '') {
                if ($lado == 'L') {
                    if (count($ids) == 0) {
                        $resul = $id;
                    }else{
                        $this->verificarOtraPosition($ids, $limiteFila, $lado);
                        $resul = $this->position;
                    }
                }elseif($lado == 'R'){
                    if (count($ids) == 0) {
                        $resul = $id;
                    }else{
                        $this->verificarOtraPosition($ids, $limiteFila, $lado);
                        $resul = $this->position;
                    }
                }
            }else{
                if (count($ids) == 0) {
                    $resul = $id;
                }else{
                    $this->verificarOtraPosition($ids, $limiteFila, $lado);
                    $resul = $this->position;
                }
            }
            return $resul;
        } catch (\Throwable $th) {
            Log::error('Tree - getPosition -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }
    /**
     * Asigna otra posición en caso de no estar disponible la primera.
     */
    public function verificarOtraPosition($arregloID, $limitePosicion, $lado)
    {
        try {
            Log::debug('Tree - verificarOtraPosition');
            foreach ($arregloID as $item) {
                $ids = $this->getIDs($item['id'], $lado);
                if ($lado != '') {
                    if ($lado == 'L') {
                        if (count($ids) == 0) {
                            $this->position = $item['id'];
                            break;
                        }else{
                            $this->verificarOtraPosition($ids, $limitePosicion, $lado);
                        }
                    }elseif($lado == 'R'){
                        if (count($ids) == 0) {
                        $this->position = $item['id'];
                            break;
                        }else{
                            $this->verificarOtraPosition($ids, $limitePosicion, $lado);
                        }
                    }
                }else{
                    if (count($ids) == 0) {
                        $this->position = $item['id'];
                        break;
                    }else{
                        $this->verificarOtraPosition($ids, $limitePosicion, $lado);
                    }
                }
            }
        } catch (\Throwable $th) {
            Log::error('Tree - verificarOtraPosition -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }
    /**
     * Obtiene el id de la persona a la cual se le asigna el lado.
     */
    public function getIDs(int $id, string $lado)
    {
      try {
        Log::debug('Tree - getIDs');
        if ($lado != '') {
            return User::where([
                ['binary_id', '=',$id],
                ['binary_side','=',$lado]
             ])->select('id')->orderBy('id')->get()->toArray();
          }else{
            return User::where([
                ['binary_id','=', $id],
             ])->select('id')->orderBy('id')->get()->toArray();
          }
      } catch (\Throwable $th) {
        Log::error('Tree - getIDs -> Error: '.$th);
        abort(403, "Ocurrio un error, contacte con el administrador");
      }
    }
}
