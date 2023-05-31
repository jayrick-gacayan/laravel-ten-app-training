<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgentController extends Controller
{
    //

    /**
     * 
     * 
     *@return view
     */
    public function AgentDashboard(){
        return view('agent.dashboard');
    }
}