<?php

namespace App\Http\Controllers;
session_start();
use App\Pelanggan;
use App\Pegawai;
use App\Hidangan;

use Illuminate\Http\Request;

class IndexController extends Controller {

    public function index(){
        $makanan = Hidangan::where('jenis_hidangan', 'Makanan')->get();
        $minuman = Hidangan::where('jenis_hidangan', 'Minuman')->get();

        if(isset($_SESSION['id_pelanggan'])){
            $row = Pelanggan::where('id_pelanggan', $_SESSION['id_pelanggan'])->first();
            $pelanggan = [
                'id_pelanggan' => $row['id_pelanggan'],
                'nama_pelanggan' => $row['nama_pelanggan'],
                'email_pelanggan' => $row['email_pelanggan'],
                'username_pelanggan' => $row['username_pelanggan'],
            ];
            $islogin = ['login' => 'pelanggan'];
            return view('index', compact('pelanggan', 'islogin', 'makanan', 'minuman'));
        } else if(isset($_SESSION['id_pegawai'])){
            $row = Pegawai::where('id_pegawai', $_SESSION['id_pegawai'])->first();
            $pegawai = [
                'id_pegawai' => $row['id_pegawai'],
                'nama_pegawai' => $row['nama_pegawai'],
                'email_pegawai' => $row['email_pegawai'],
                'username_pegawai' => $row['username_pegawai'],
                'jabatan_pegawai' => $row['jabatan_pegawai'],
            ];
            $islogin = ['login' => 'pegawai'];
            return view('index', compact('pegawai', 'islogin', 'makanan', 'minuman'));
        } else {
            $islogin = ['login' => 'false'];
            return view('index', compact('islogin', 'makanan', 'minuman'));
        }
    }
    public function getHidangan($jenis_hidangan){
        Hidangan::where('jenis_hidangan', $jenis_hidangan)->get();
    }
}