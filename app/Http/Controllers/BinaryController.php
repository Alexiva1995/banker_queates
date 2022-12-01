<?php

namespace App\Http\Controllers;

use App\Models\BinaryPoint;
use App\Models\Investment;
use App\Models\User;
use App\Models\WalletComission;
use Illuminate\Database\Eloquent\Collection;
class BinaryController extends Controller
{
    /**
     * Procedimiento de corte binario (proviene de Terra)
     */
    public function usdtbonobinario()
    {

        $point_group = BinaryPoint::where('status', 0)->select('user_id')->groupBy('user_id')->get();

        foreach ($point_group as $item) {

            $id = $item->user_id;
            $usuario = User::findOrFail($id);
            // Valida si el referido tiene un hijo directo por cada lado 
            $referred_left = User::where('binary_id', $usuario->id)->where('binary_side', 'L')->exists();
            $referred_right = User::where('binary_id', $usuario->id)->where('binary_side', 'R')->exists();

            if ($referred_left && $referred_right) {

                $binary_points = BinaryPoint::where('user_id', $id)->where('status', 0)->get();

                $point_right = BinaryPoint::where('user_id', $id)->where('status', 0)->sum('right_points');

                $point_left = BinaryPoint::where('user_id', $id)->where('status', 0)->sum('left_points');

                $menber = Investment::where('user_id', $id)->where('status', '1')->first();

                $user_referred = User::where('id', $id)->first();

                // Armamos una coleccion o lista para contener los elementos a trabajar en su respectivo lado
                $lista_pierna_derecha = new Collection();
                $lista_pierna_izquierda = new Collection();

                $resta = $point_right - $point_left;

                $resta = -$resta;
                // Invierte los valores en caso de generar resultados negativos
                if ($resta < 0) $resta = -$resta;

                if ($point_right < $point_left) {
                    if ($point_right >= 150) {
                        if ($id != 1) {
                            if ($menber != null) {
                                // Se aplica el 20%
                                $bonus_t = $point_right * 0.20;
                                $this->createBonusBinary($id,$bonus_t, $point_right, $user_referred);
                            }
                            // Asignamos cada elemento a la lista en la cual correspondan.
                            foreach ($binary_points as $binary_point) {

                                if ($binary_point->right_points > 0) {
                                    $lista_pierna_derecha->push($binary_point);
                                } else {
                                    $lista_pierna_izquierda->push($binary_point);
                                }
                            }
                            $this->subtractPointsWhenLeftItsMayor($lista_pierna_derecha, $lista_pierna_izquierda);
                        }
                    }
                } elseif ($point_right > $point_left) {
                    if ($point_left >= 150) {
                        if ($id != 1) {
                            if ($menber != null) {
                                // Se aplica el 20%
                                $bonus_t = $point_left * 0.20;
                                $this->createBonusBinary($id,$bonus_t, $point_left, $user_referred);
                            }
                            // Asignamos cada elemento a la lista en la cual correspondan.
                            foreach ($binary_points as $binary_point) {

                                if ($binary_point->left_points > 0) {
                                    $lista_pierna_izquierda->push($binary_point);
                                } else {
                                    $lista_pierna_derecha->push($binary_point);
                                }
                            }
                            $this->subtractPointsWhenRightItsMayor($lista_pierna_izquierda, $lista_pierna_derecha);
                        }
                    }

                } elseif($point_right == $point_left) {
                    if($point_right >= 150) {
                        if ($id != 1) {
                            if ($menber != null) {
                                // Se aplica el 20%
                                $bonus_t = $point_right * 0.20;
                                $this->createBonusBinary($id,$bonus_t, $point_right, $user_referred);
                            }
                            // Asignamos cada elemento a la lista en la cual correspondan.
                            foreach ($binary_points as $binary_point) {

                                if ($binary_point->left_points > 0) {
                                    $lista_pierna_izquierda->push($binary_point);
                                } else {
                                    $lista_pierna_derecha->push($binary_point);
                                }
                            }
                            $this->bothSideAreEquals($lista_pierna_izquierda, $lista_pierna_derecha);
                        }
                    }
                }
            }
        }
    }
    /**
     * Crea el bono binario por el lado derecho 
     */
    private function createBonusBinary($id, $bonus_t, $points, $user_referred)
    {
        if ($bonus_t != 0) {
            WalletComission::Create([
                'type' => 1,
                'level' => 0,
                'user_id' => $id,
                'amount' => $bonus_t,
                'amount_available' => $bonus_t,
                'buyer_id' => $user_referred->buyer_id,
                'description' => "Puntos que se utilizaron para generar el bono {$points}"
            ]);
        }
    }
    /**
     * Realiza la resta de los puntos cuando el lado mayor es el izquierdo y el derecho es menor
     * @param Illuminate\Database\Eloquent\Collection El primer parametro es la coleccion que contiene los elementos del lado menor
     * @param Illuminate\Database\Eloquent\Collection El segundo parametro es la coleccion que contiene los elementos del lado mayor
     */
    private function subtractPointsWhenLeftItsMayor($lista_saldo_menor, $lista_saldo_mayor)
    {
        // variable que se emplea para recorrer los elementos de la lista del lado mayor
        $contador = 0;
        // For para recorrer cada elemento de la lista del lado menor y realizar la resta
        for ($i = 0; $i < count($lista_saldo_menor); $i++) {
            // Realizamos la resta entre el item de la pierna mayor, menos el item de la pierna menor
            $result = $lista_saldo_mayor[$contador]->left_points -= $lista_saldo_menor[$i]->right_points;

            // Si el resultado de la resta es un numero positivo, seguimos restando con ese elemento,
            // Y actualizamos el elemento menor restado a amount 0 y status 1
            if ($result > 0) {
                $lista_saldo_menor[$i]->right_points = 0;
                $lista_saldo_menor[$i]->status = 1;
                $lista_saldo_mayor[$contador]->update();
                $lista_saldo_menor[$i]->update();

                //Si el resultado de la resta es un número negativo, asignamos ese resultado
            } else if ($result < 0) {
                // Asignamos el número negativo al elemento de la pierna menor, multiplicandolo por -1 para guardarlo como positivo.
                // Y actualizamos el elemento de la lista de la pierna mayor a 0 y status 1
                $lista_saldo_menor[$i]->right_points = $result * -1;
                $lista_saldo_menor[$i]->update();
                $lista_saldo_mayor[$contador]->left_points = 0;
                $lista_saldo_mayor[$contador]->status = 1;
                $lista_saldo_mayor[$contador]->update();

                $contador++;
                $i--;
            } else {
                $lista_saldo_menor[$i]->update(['status' => 1, 'right_points' => 0]);
                $lista_saldo_menor[$contador]->status = 1;
                $lista_saldo_mayor[$contador]->update();
            }
        }
    }
    /**
     * Realiza la resta de los puntos cuando el lado mayor es el derecho y el izquierdo es menor
     * @param Illuminate\Database\Eloquent\Collection El primer parametro es la coleccion que contiene los elementos del lado menor
     * @param Illuminate\Database\Eloquent\Collection El segundo parametro es la coleccion que contiene los elementos del lado mayor
     */
    private function subtractPointsWhenRightItsMayor($lista_saldo_menor, $lista_saldo_mayor)
    {
        // variable que se emplea para recorrer los elementos de la lista del lado mayor
        $contador = 0;
        // For para recorrer cada elemento de la lista del lado menor y realizar la resta
        for ($i = 0; $i < count($lista_saldo_menor); $i++) {

            // Realizamos la resta entre el item de la pierna mayor, menos el item de la pierna menor
            $result = $lista_saldo_mayor[$contador]->right_points -= $lista_saldo_menor[$i]->left_points;

            // Si el resultado de la resta es un numero positivo, seguimos restando con ese elemento,
            // Y actualizamos el elemento menor restado a amount 0 y status 1
            if ($result > 0) {
                $lista_saldo_menor[$i]->left_points = 0;
                $lista_saldo_menor[$i]->status = 1;
                $lista_saldo_mayor[$contador]->update();
                $lista_saldo_menor[$i]->update();

                //Si el resultado de la resta es un número negativo, asignamos ese resultado
            } else if ($result < 0) {
                // Asignamos el número negativo al elemento de la pierna menor, multiplicandolo por -1 para guardarlo como positivo.
                // Y actualizamos el elemento de la lista de la pierna mayor a 0 y status 1
                $lista_saldo_menor[$i]->left_points = $result * -1;
                $lista_saldo_mayor[$contador]->right_points = 0;
                $lista_saldo_mayor[$contador]->status = 1;
                $lista_saldo_menor[$i]->update();
                $lista_saldo_mayor[$contador]->update();

                $contador++;
                $i--;
                // Si el resultado es igual a 0
            } else {
                $lista_saldo_menor[$i]->update(['status' => 1, 'left_points' => 0]);
                $lista_saldo_menor[$contador]->status = 1;
                $lista_saldo_mayor[$contador]->update();
            }
        }
    }
    /**
     * Setea todos los puntos de todos los elementos de cada lado a 0 y a status 1
     * @param Illuminate\Database\Eloquent\Collection El primer parametro es la coleccion que contiene los elementos del lado menor
     * @param Illuminate\Database\Eloquent\Collection El segundo parametro es la coleccion que contiene los elementos del lado mayor
     */
    private function bothSideAreEquals($lista_saldo_menor, $lista_saldo_mayor)
    {
        foreach($lista_saldo_menor as $item_menor) {
            $item_menor->update([
                'right_points' => 0,
                'left_points' => 0,
                'status' => 1
            ]);
        }

        foreach($lista_saldo_mayor as $item_mayor) {
            $item_mayor->update([
                'right_points' => 0,
                'left_points' => 0,
                'status' => 1
            ]);
        }
    }
}
