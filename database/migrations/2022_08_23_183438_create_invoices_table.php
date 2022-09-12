<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->String('invoice_number');
            $table->date('invoice_date');
            $table->date('due_date');
            $table->String('product');
            $table->decimal('Amount_collection', 8, 2)->nullable();;
            $table->decimal('Amount_Commission', 8, 2);
            $table->decimal('discount', 8, 2);
            $table->String('rate_vat', 999);
            $table->decimal('value_vat', 8, 2);
            $table->decimal('total', 8, 2);
            $table->String('status', 50);
            $table->integer('value_status');
            $table->date('Payment_Date')->nullable();
            $table->text('note')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreignId('section_id')->constrained('sections')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};
