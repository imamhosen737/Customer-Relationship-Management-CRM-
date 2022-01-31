<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposalItems', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('proposal_id')->index();
            // $table->unsignedBigInteger('item_id')->index();
            $table->decimal('price', 10, 2);
            $table->decimal('qty', 10, 2);
            $table->foreignId('item_id')->references('id')->on('items')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('proposal_id')->references('id')->on('proposals')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            
        });

        
    }

        // $table->id();
        // $table->foreignId('proposal_id')->references('id')->on('proposals')->onDelete('cascade')->onUpdate('cascade');
        // $table->foreignId('item_id')->references('id')->on('items')->onDelete('cascade')->onUpdate('cascade');
        //  $table->decimal('price');
        //  $table->decimal('qty');
        //  $table->timestamps();


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proposal_items');
    }
}
