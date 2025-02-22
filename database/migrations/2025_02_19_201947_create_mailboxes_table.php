<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mailboxes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('send_by');
            $table->foreign('send_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('receive_by');
            $table->foreign('receive_by')->references('id')->on('users')->onDelete('cascade');
            $table->text('message');
            $table->enum('status', ['sent', 'draft', 'deleted'])->default('sent');
            $table->softDeletes();
            $table->timestamp('read_at')->nullable();            
            $table->timestamp('draft_at')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('received_at')->nullable();
            $table->timestamp('replied_at')->nullable();
            $table->timestamp('forwarded_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mailboxes');
    }
};
