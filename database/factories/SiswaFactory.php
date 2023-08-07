<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\siswa>
 */
class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->name(),
            'tempat_lahir' => fake()->city,
            'tanggal_lahir' => fake()->date('Y-m-d'),
            'jenis_kelamin' => fake()->randomElements(['Laki - laki', 'Perempuan']),
            'agama' => 'Islam',
            // 'whatsapp' => fake()->unique()->randomNumber(5, true),
            'whatsapp' => fake()->unique()->text(),
            'nama_ayah' => fake()->name,
            'nama_ibu' => fake()->name,
            'alamat' => fake()->address,
            'asal_sekolah' => fake()->city,
            'jurusan' => fake()->randomElements(['Teknik Kendaraan Ringan Otomotif (TKRO)', 'Desain Komunikasi Visual (DKV)', 'Akuntansi & Keuangan Lembaga (AKL']),
            'status' => fake()->numberBetween(0, 3),
            


            // $table->id();
            // $table->string('nama');
            // $table->string('tempat_lahir');
            // $table->date('tanggal_lahir');
            // $table->string('jenis_kelamin');
            // $table->string('agama');
            // $table->string('whatsapp')->unique();
            // $table->string('nama_ayah');
            // $table->string('nama_ibu');
            // $table->text('alamat');
            // $table->string('asal_sekolah');
            // $table->string('jurusan');
            // $table->integer('status')->default(0); // 0 = validasi 1 = diterima 2 = ditolak
            // $table->timestamps();
        ];
    }
}
