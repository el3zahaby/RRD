<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class mksite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mksite {--config}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create site config';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $config = $this->option('config');
        if (($config) == null) {
            envUpdate(['APP_URL'=>"".request()->getHost(),'APP_DOMAIN'=>request()->getHost()]);

            Artisan::call('migrate', array(), $this->getOutput());
            $this->comment("");

            if((DB::table('roles')->get())->isEmpty()) {
                Artisan::call('db:seed', array(), $this->getOutput());
            }
            $this->comment("");
            $this->comment('    Site is DONE :) ');

        }
        if((User::all())->isEmpty()){
            $this->comment("Create a SuperUser(admin):");

            $su = new User();
            $su->fullname = $this->ask('what is your name?','admin');
            $su->username = $this->ask('Chose your Username?','admin');
            $su->email = $this->ask('what is your email?');
            $su->password = Hash::make($this->ask('what is your password?'));
            $su->role()->insert(['roles_id'=>1,'user_id'=>1]);
            $su->save();
            $this->comment('    Super user is DONE :) ');
        }

        Artisan::call('mksite:config', array(), $this->getOutput());




    }
}
