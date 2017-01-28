<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Scene extends Model
{
    //
	protected $table = 'scene'; 
	protected $fillable = ['label','description', 'camera_position_x', 'camera_position_y', 'camera_position_z', 
	    'camera_dop_x', 'camera_dop_y', 'camera_dop_z', 'camera_vup_x', 'camera_vup_y',
	    'camera_vup_z', 'camera_angle_view', 'light_position_x', 'light_position_y', 
	    'light_position_z', 'light_color_r', 'light_color_g', 'light_color_b',
	    'light_color_a', 'waveFront', 'materials', 'map_kd', 'fio_arame'
	];
	//protected $guarded = [];
  	public $timestamps = false; 
}
