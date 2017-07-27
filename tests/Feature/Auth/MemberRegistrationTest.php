<?php

namespace Tests\Feature\Auth;

use App\Entities\Users\User;
use Tests\TestCase;

class MemberRegistrationTest extends TestCase
{
    /** @test */
    public function registration_validation()
    {
        $this->visit(route('auth.register'));
        $this->type('', 'name');
        $this->type('', 'username');
        $this->type('member@app.dev', 'email');
        $this->type('', 'password');
        $this->type('', 'password_confirmation');
        $this->press('Buat Akun Baru');
        $this->seePageIs(route('auth.register'));
        $this->see('Nama harus diisi.');
        $this->see('Username harus diisi.');
        $this->see('Email ini sudah terdaftar.');
        $this->see('Password harus diisi.');
        $this->see('Konfirmasi password harus diisi.');

        $this->type('Nama Member', 'name');
        $this->type('namamember', 'username');
        $this->type('email', 'email');
        $this->type('password', 'password');
        $this->type('password..', 'password_confirmation');
        $this->press('Buat Akun Baru');
        $this->seePageIs(route('auth.register'));
        $this->see('Email tidak valid.');
        $this->see('Konfirmasi password tidak sesuai.');
    }

    /** @test */
    public function member_register_successfully()
    {
        $this->visit(route('auth.register'));
        $this->type('Nama Member', 'name');
        $this->type('namamember', 'username');
        $this->type('email@mail.com', 'email');
        $this->type('password.111', 'password');
        $this->type('password.111', 'password_confirmation');
        $this->press('Buat Akun Baru');
        $this->seePageIs(route('home'));
        $this->see('Selamat datang Nama Member.');
    }
}