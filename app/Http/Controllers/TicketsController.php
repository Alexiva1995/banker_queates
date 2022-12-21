<?php

namespace App\Http\Controllers;

use App\Models\Tickets;
use Illuminate\Http\Request;
use App\Models\MessageTicket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use App\Models\User;


class TicketsController extends Controller
{

    //Tickets Del Admin

    // permite ver la lista de tickets

    public function listAdmin(Request $request)
    {
        $date_from = null;
        $date_to = null;
        $ticket_status = [];

        if($request->isMethod('post'))
        {
            $query = Tickets::where('id', '!=', '1');

            if($request->has('ticket_status') && $request->ticket_status !== null) 
            {
                $ticket_status = $request->ticket_status;

                $query->whereIn('status', $ticket_status);
            }

            if($request->has('date_from') && $request->date_from !== null && $request->has('date_to') && $request->date_to != null)
            {
                $date_from = $request->date_from;

                $date_to = $request->date_to;

                $query->whereDate('created_at', '>=', $date_from)
                      ->whereDate('created_at', '<=', $date_to);
            }

            $ticket = $query->orderBy('updated_at', 'desc')->get();

            return view('tickets.componenteTickets.admin.list-admin', compact('ticket', 'date_from', 'date_to', 'ticket_status'));

        }

        $ticket = Tickets::all();

        foreach ($ticket as $ticke) {

            $message = MessageTicket::where('id_ticket', '=', $ticke->id)
                ->where('type', 0)
                ->select('updated_at')
                ->orderBy('id', 'desc')
                ->first();
            $ticke->send = '';
            if ($message != null) {
                // $ticke->send = $message->updated_at->diffForHumans();
                $ticke->send = $message->updated_at->format('d-m-Y');
            }
        }

        return view('tickets.componenteTickets.admin.list-admin', compact('ticket', 'date_from', 'date_to', 'ticket_status'));
    }


    // Permite ver el ticket
    public function showAdmin($id)
    {
        $ticket = Tickets::find($id);
        $message = MessageTicket::all()->where('id_ticket', $id);
        $email = User::find(1);
        $admin = $email->email;
        return view('tickets.componenteTickets.admin.show-admin')
            ->with('ticket', $ticket)
            ->with('message', $message)->with('admin', $admin);
    }

    // permite editar el ticket

    public function editAdmin($id)
    {
        $ticket = Tickets::find($id);
        $message = MessageTicket::where('id_ticket', $id)->orderby('created_at', 'ASC')->get();
        $email = User::all()->where('id');
        $findUser = User::find($ticket->user_id);
        $emailUser = $findUser->email;

        $admin = $email[0]->email;
        return view('tickets.componenteTickets.admin.edit-admin')
            ->with('ticket', $ticket)
            ->with('message', $message)
            ->with('emailUser', $emailUser)
            ->with('admin', $admin);
    }
    // permite actualizar el ticket

    public function updateAdmin(Request $request, $id)
    {
        $ticket = Tickets::find($id);

        $ticket->update($request->all());
        $ticket->save();

        $validate = $request->validate([
            'image' => 'image|max:2048',
            // 'message' => 'min:2'
        ]);

        if ($validate && $request->hasFile('image')) {
            $imagen = $request->file('image');
            $nombre = time() . '.' . $imagen->getClientOriginalName();
            $destino = public_path('storage');
            $request->image->move($destino, $nombre);

            MessageTicket::create([
                'user_id' => $ticket->user_id,
                'id_admin' => Auth::id(),
                'id_ticket' => $ticket->id,
                'type' => '1',
                'message' => request('message'),
                'image' => $nombre
            ]);
        } else {
            MessageTicket::create([
                'user_id' => $ticket->user_id,
                'id_admin' => Auth::id(),
                'id_ticket' => $ticket->id,
                'type' => '1',
                'message' => request('message'),
            ]);
        }


        return redirect()->route('ticket.edit-admin', $ticket->id)->with('success', 'El Ticket se actualizo Exitosamente');
    }



    /**
     * Permite obtener la cantidad de Tickets que tiene un usuario
     *
     * @param integer $user_id
     * @return integer
     */
    public function getTotalTickets($user_id): int
    {
        try {
            $Tickets = Tickets::where('user_id', $user_id)->get()->count('id');
            if ($user_id == 1) {
                $Tickets = Tickets::all()->count('id');
            }
            return $Tickets;
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Permite obtener el total de Tickets por meses
     *
     * @param integer $user_id
     * @return array
     */
    public function getDataGraphiTickets($user_id): array
    {
        try {
            $totalTickets = [];
            if (Auth::user()->admin == 1) {
                $Tickets = Tickets::select(DB::raw('COUNT(id) as Tickets'))->where([['status', '>=', 0]])
                    ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
                    ->orderBy(DB::raw('YEAR(created_at)'), 'ASC')
                    ->orderBy(DB::raw('MONTH(created_at)'), 'ASC')
                    ->take(6)
                    ->get();
            } else {
                $Tickets = Tickets::select(DB::raw('COUNT(id) as Tickets'))
                    ->where([
                        ['user_id', '=',  $user_id],
                        ['status', '>=', 0]
                    ])
                    ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
                    ->orderBy(DB::raw('YEAR(created_at)'), 'ASC')
                    ->orderBy(DB::raw('MONTH(created_at)'), 'ASC')
                    ->take(6)
                    ->get();
            }
            foreach ($Tickets as $ticket) {
                $totalTickets[] = $ticket->Tickets;
            }
            return $totalTickets;
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    // permite ver la vista de creacion del ticket
    public function create()
    {
        $email = User::find(1);
        $admin = $email->email;
        return view('tickets.create')->with('admin', $admin);
    }

    // permite la creacion del ticket
    public function store(Request $request)
    {
        


        $validate = $request->validate([
            'image' => 'image|max:2048',
            'message' => 'min:2'

        ]);
        
        Tickets::create([
            'user_id' => Auth::id(),
            'issue' => request('issue'),
            'categories' => request('categories')
            // 'priority' => request('priority')
        ]);

        $ticket_create = Tickets::where('user_id', Auth::id())->orderby('created_at', 'DESC')->take(1)->get();
        $id_ticket = $ticket_create[0]->id;

        if ($validate && $request->hasFile('image')) {
            $imagen = $request->file('image');
            $nombre = time() . '.' . $imagen->getClientOriginalName();
            $destino = public_path('storage');
            $request->image->move($destino, $nombre);


            MessageTicket::create([
                'user_id' => Auth::id(),
                'id_admin' => '1',
                'id_ticket' => $id_ticket,
                'type' => '0',
                'message' => request('message'),
                'image' => $nombre

            ]);
        } else {
            MessageTicket::create([
                'user_id' => Auth::id(),
                'id_admin' => '1',
                'id_ticket' => $id_ticket,
                'type' => '0',
                'message' => request('message'),
            ]);
        }

        return redirect()->route('ticket.edit-user', $id_ticket)->with('success', 'El Ticket se creo Exitosamente');
    }

    // permite editar el ticket
    public function editUser($id)
    {
        $ticket = Tickets::find($id);
        $findUser = User::find($ticket->user_id);
        $emailUser = $findUser->email;

        if ($ticket <> null and $ticket->user_id == Auth::user()->id) {
                $message = MessageTicket::where('id_ticket', $id)->orderby('created_at', 'ASC')->get();
                $imagenes = MessageTicket::all('image');
                $email = User::all()->where('id');
                $admin = $email[0]->email;
                return view('tickets.componenteTickets.user.edit-user', compact('imagenes'))
                    ->with('ticket', $ticket)
                    ->with('emailUser', $emailUser)
                    ->with('message', $message)->with('admin', $admin);
            } else {
                return abort(403, "No tienes autorización para ingresar a esta seccion.");
            }
    }

    // permite actualizar el ticket
    public function updateUser(Request $request, $id)
    {

        $ticket = Tickets::find($id);
        $ticket->update($request->all());

        $validate = $request->validate([
            'image' => 'image|max:2048',
            'message' => 'min:2'
        ]);

        if ($validate && $request->hasFile('image')) {
            $imagen = $request->file('image');
            $nombre = time() . '.' . $imagen->getClientOriginalName();
            $destino = public_path('storage');
            $request->image->move($destino, $nombre);


            MessageTicket::create([
                'user_id' => Auth::id(),
                'id_admin' => '1',
                'id_ticket' => $ticket->id,
                'type' => '0',
                'message' => request('message'),
                'image' => $nombre
            ]);
        } else {
            MessageTicket::create([
                'user_id' => Auth::id(),
                'id_admin' => '1',
                'id_ticket' => $ticket->id,
                'type' => '0',
                'message' => request('message'),
            ]);
        }

        $ticket->save();

        return redirect()->route('ticket.edit-user', $ticket->id)->with('success', 'el ticket se Actualizo Correctamente');
    }

    // permite ver la lista de tickets
    public function listUser(Request $request)
    {

        $ticket = Tickets::where('user_id', Auth::id())->get();
        foreach ($ticket as $ticke) {
            $message = MessageTicket::where('id_ticket', '=', $ticke->id)
                ->where('type', 1)
                ->select('updated_at')
                ->orderBy('id', 'desc')
                ->first();
            $ticke->send = '';
            if ($message != null) {
                // $ticke->send = $message->updated_at->diffForHumans();
                $ticke->send = $message->updated_at->format('d-m-Y');
            }
        }
        return view('tickets.componenteTickets.user.list-user')
            ->with('ticket', $ticket);
    }

    // permite ver el ticket
    public function showUser($id)
    {
        $ticket = Tickets::find($id);

        if ($ticket <> null and $ticket->user_id == Auth::user()->id) {
            $message = MessageTicket::all()->where('id_ticket', $id);
            $email = User::find(1);
            $admin = $email->email;
            $findUser = User::find($ticket->user_id);
            $emailUser = $findUser->email;
            return view('tickets.componenteTickets.user.show-user')
                ->with('ticket', $ticket)
                ->with('message', $message)
                ->with('emailUser', $emailUser)
                ->with('admin', $admin);
        } else {
            return abort(403, "No tienes autorización para ingresar a esta seccion.");
        }
    }
}
