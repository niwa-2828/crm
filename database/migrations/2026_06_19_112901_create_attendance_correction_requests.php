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
        Schema::create('attendance_correction_requests', function (Blueprint $table) {
            $table->id();

            // 外部キーで、勤怠のidを見る。
            $table->foreignId('attendance_id')->constrained('attendances');
            // 外部キーで、ユーザーidを見る。
            $table->foreignId('user_id')->constrained('users');
        
            // カラム名にはrequestedをつけて、申請だと分かるようにする。
            $table->date('requested_work_date')->nullable();
            $table->Time('requested_clock_in')->nullable();
            $table->Time('requested_break_in')->nullable();
            $table->Time('requested_break_out')->nullable();
            $table->Time('requested_clock_out')->nullable();
        
            $table->text('reason')->nullable();
            $table->text('admin_comment')->nullable();
        
            $table->string('status')->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance_correction_requests');
    }
};
