<?php

use Bavix\Wallet\Models\Transaction;
use Bavix\Wallet\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{

    /**
     * @return string
     */
    protected function table(): string
    {
        return (new Wallet())->getTable();
    }

    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create($this->table(), function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('holder');
            $table->string('name');
            $table->string('slug')->index();
            $table->string('description')->nullable();
            $table->bigInteger('balance')->default(0);
            $table->timestamps();

            $table->unique(['holder_type', 'holder_id', 'slug']);
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::drop($this->table());
    }

}
