<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('beritas', function (Blueprint $table) {
            $table->id(); 
            $table->string('judul'); 
            $table->text('isi'); 
            $table->date('tanggal'); 
            $table->string('caption')->nullable(); 
            $table->string('gambar')->nullable(); 
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('beritas');
    }
};
