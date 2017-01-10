<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Scene extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('scene', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label', 10);
            $table->string('description', 255);

            // camera
            $table->double('camera_position_x', 15,8);
            $table->double('camera_position_y', 15,8);
            $table->double('camera_position_z', 15,8);
            $table->double('camera_dop_x', 15,8);
            $table->double('camera_dop_y', 15,8);
            $table->double('camera_dop_z', 15,8);
            $table->double('camera_vup_x', 15,8);
            $table->double('camera_vup_y', 15,8);
            $table->double('camera_vup_z', 15,8);
            $table->double('camera_angle_view', 15,8);

            // luz
            $table->double('light_position_x', 15,8);
            $table->double('light_position_y', 15,8);
            $table->double('light_position_z', 15,8);
            $table->float('light_color_r', 4,6);
            $table->float('light_color_g', 4,6);
            $table->float('light_color_b', 4,6);
            $table->float('light_color_a', 4,6);

            // objeto
            $table->longText('waveFront')->nullable();

            // material
            $table->longText('materials')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
       Schema::drop('scene');
    }
}