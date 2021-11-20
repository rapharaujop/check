<?php

namespace App\Http\Controllers;

use App\User;
use App\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $users = User::all();
        return view("site.listUsers",[
            'users' => $users
        ]);
    }
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store(Request $request){
        $valid_email = DB::table('users')->where('email', '=', $request->email)->get()->first();
        if(!isset($valid_email->email) || $valid_email->email != $request->email){
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->commission = $request->commission;
            $user->save();
            return redirect()->route('user.index');
        }else{
            $alert =  'Não foi possível cadastrar o e-mail "'.$request->email.'" pois já consta em nossa base de dados';
            return view('site.newUser', ['alert' => $alert]);
        }
        
    } 

   /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('site.newUser');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user){
        $contracts_user     = new Contract();
        $contracts          = $user->contracts()->get();
        dd($contracts);
        if($contracts){
            $commission_total = 0;
            foreach($contracts as $contract){
                $commissions  = array();
                $contract->closure_at = date('d/m/Y', strtotime($contract->closure_at));                
                $contracts_user = Contract::with('users')->find($contract->id); 
                //ENCONTRAR A COMISSÃO DO USER E SABER QUANTOS VENDEDORES            
                foreach($contracts_user->users as $commission){
                    array_push($commissions, $commission->commission);
                    if($commission->email == $user->email){
                        $contract->commission = $commission->commission;
                    }
                }
                //SE MAIS DE UM VENDEDOR DIVIDE A COMISSÃO POR 2
                if(isset($commissions) && sizeof($commissions) == 2){
                    $contract->commission = $contract->commission/2;
                }
                $contract->commission_value = ($contract->contract_value*$contract->commission)/100;
                $contract->commission_total = $commission_total + $contract->commission_value;                
                $commission_total           = $contract->commission_total;
            }
        }

        return view("site.dataUser",[
            'user'      => $user,
            'contracts' => $contracts,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */

    public function edit(User $user){
        return view("site.editUser",[
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */

    public function update(User $user, Request $request){

        $user->name = $request->name;
        $user->commission = $request->commission;
        
        $user->save();
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */

    public function destroy(User $user){
        $user->delete();
        $user->contracts()->sync($user);
        return redirect()->route('user.index');
    }
}
