<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\State\Entities\State;
use Modules\Districts\Entities\Districts;
use Throwable;
use DB;
class AddSatesDistricts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:state-districts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add States Districts';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::beginTransaction();
        try {

            $states=ProvincesDistricts();

            foreach(json_decode($states) as $key=> $st)
            {
                $state=State::create([
                    'country_id'=>1,
                    'name'=>$key
                ]);
                foreach ($st as $diskey => $dis) {

                    Districts::create([
                        'country_id'=>1,
                        'state_id'=>$state->id,
                        'name'=>$dis->Name
                    ]);
                }

            }

            GenerateSystemLog(['model'=>'state-districts','message'=>now().' States & Districts successfully added']);
            $this->line('States & Districts successfully added');

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            GenerateSystemLog(['model'=>'state-districts','message'=>now().' Something went wrong while adding state districts with this error: '.$e->getMessage()]);
            $this->line('Something went wrong while adding state districts this error: '.$e->getMessage());
        } catch (Throwable $e){
            DB::rollback();
            GenerateSystemLog(['model'=>'state-districts','message'=>now().' Something went wrong while adding state districts with this error: '.$e->getMessage()]);
            $this->line('Something went wrong while adding state districts this error: '.$e->getMessage());

        }
    }
}
