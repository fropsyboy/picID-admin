<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Carbon\Carbon;


class Subscribe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'word:day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates the subscribers details';

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
        //

        $trialusers = User::where('sub', 'Trial')->get();
        $subusers = User::where('sub', 'Subscribed')->get();
        $current = Carbon::now();
        $currentMonth = $current->month;
        $currentYear = $current->year;

        

        foreach ($trialusers as $user){
            $end = Carbon::parse($user->created_at);
            $length = $end->diffInDays($current);

            if( $length >= 7 ){
                User::where('id', $user->id)->update([
                    'sub' => 'Expired',
                ]);
            }
        }

        foreach ($subusers as $user){
            $end = Carbon::parse($user->subDate);
            $length = $end->diffInDays($current);

            if( $length >= 30 ){
                User::where('id', $user->id)->update([
                    'sub' => 'Expired',
                ]);
            }
        }

        $this->info('data updated succcessfully');
    }
}
