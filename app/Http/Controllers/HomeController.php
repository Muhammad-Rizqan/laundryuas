<?php

     namespace App\Http\Controllers;

     use Illuminate\Http\Request;

     class HomeController extends Controller {
         public function index() {
             $packages = \App\Models\Package::all();  // Ambil paket untuk display
             return view('landing', compact('packages'));
         }
     }