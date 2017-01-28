<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Db;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Scene;
use App\Vec3;
use App\Triangle;
use App\Cena;
use App\Camera;
use App\Light;
use App\Color;
use App\Material;
use App\Actor;

class apiController extends Controller
{
    public function lista(){
		  $scenes =  DB::table('scene')->select('id', 'label', 'description');
		  return $scenes->get();
    }

    public function busca($id) {
		$scene = Scene::find($id);
		$scene->numberOfVertices = 0;
		$scene->numberOfNormals = 0;
		$scene->numberOfTriangles = 0;
		$scene->numberOfColors = 0;
		$scene->numberOfTextures = 0;
		$this->tratarWaveFront($scene);
		$this->tratarMaterial($scene);
		unset($scene['waveFront']);
		unset($scene['materials']);
		$cena = $this->setarCena($scene);
	  	return $cena;
    }

    public function buscaLabel($label) {
	  return DB::table('scene')->select('id', 'label', 'description')->
					  where('label', 'like', '%'.$label.'%')->get();
    }


	private function setarCena($scene) {
		$cena = new Cena();
		$cena->id = $scene->id;
		$cena->label = $scene->label;
		$cena->description = $scene->description;
		$camera = new Camera();
		$camera->position = new Vec3();
		$camera->position->x = $scene->camera_position_x+0.00;
	    $camera->position->y = $scene->camera_position_y+0.00;
	    $camera->position->z = $scene->camera_position_z+0.00;
	    $camera->dop = new Vec3();
	    $camera->dop->x = $scene->camera_dop_x+0.00;
	    $camera->dop->y = $scene->camera_dop_y+0.00;
	    $camera->dop->z = $scene->camera_dop_z+0.00;
	    $camera->vup = new Vec3();
	    $camera->vup->x = $scene->camera_vup_x+0.00;
	    $camera->vup->y = $scene->camera_vup_y+0.00;
	    $camera->vup->z = $scene->camera_vup_z+0.00;
	    $camera->angle_view = $scene->camera_angle_view+0.00;
	    $cena->camera = $camera;

	    $light = new Light();
	    $light->position = new Vec3();
	    $light->position->x = $scene->light_position_x+0.00;
	    $light->position->y = $scene->light_position_y+0.00;
	    $light->position->z = $scene->light_position_z+0.00;
	    $light->color = new Color();
	    $light->color->r = $scene->light_color_r+0.00;
	    $light->color->g = $scene->light_color_g+0.00;
	    $light->color->b = $scene->light_color_b+0.00;
	    $light->color->a = $scene->light_color_a+0.00;
	    $cena->light = $light;

	    $actor = new Actor();
		$actor->numberOfVertices = $scene->numberOfVertices;
	  	//$actor->numberOfNormals = $scene->numberOfNormals;
		if ($scene->numberOfNormals>0) {
		  $actor->numberOfNormals = $scene->numberOfVertices;
		} else {
			$actor->numberOfNormals = 0;
		}
	  	$actor->numberOfTriangles = $scene->numberOfTriangles;
	  	$actor->numberOfColors = $scene->numberOfColors;
	  	if ($scene->numberOfTextures>0) {
	  	//$actor->numberOfTextures = $scene->numberOfTextures;
	  	  $actor->numberOfTextures = $scene->numberOfVertices;
	  	} else {
	  		$actor->numberOfTextures = 0;
	  	}  
	  	$actor->material = $scene->material;
	  	$actor->vertices = $scene->vertices;
	  	$actor->triangles = $scene->triangles;
	  	$actor->normals = $scene->normals;
	  	$actor->colors = $scene->colors;
	  	$actor->textures = $scene->textures;
	  	$actor->fio_arame = $scene->fio_arame;
	  	//$actor->textures1 = $scene->textures1;
	  	
	  	$cena->actor = $actor;

	  	return $cena;
	}

	private function tratarMaterial(&$scene) {
		$material = new Material();
		$material->ns = 0.00;
		$material->tr = 0.00;
		$material->map_kd = url().'/textures/'.$scene->map_kd;
		$campos = explode(PHP_EOL, $scene->materials);
		foreach ($campos as $linha) {
		    $elementos = explode(' ', $linha);
		    switch ($elementos[0]) {
		        case 'Ka': // cor do ambiente
		        	$ka = new Color();
		        	$ka->r = $elementos[1]+0.00;
		        	$ka->g = $elementos[2]+0.00;
		        	$ka->b = $elementos[3]+0.00;
		        	$ka->a = 0.00;
		        	$material->ka = $ka;
		            break;
		        
		        case 'Kd': // cor difusa
		        	$kd = new Color();
		        	$kd->r = $elementos[1]+0.00;
		        	$kd->g = $elementos[2]+0.00;
		        	$kd->b = $elementos[3]+0.00;
		        	$kd->a = 0.00;
		        	$material->kd = $kd;
		            break;

		        case 'Ks': // cor specular
		        	$ks = new Color();
		        	$ks->r = $elementos[1]+0.00;
		        	$ks->g = $elementos[2]+0.00;
		        	$ks->b = $elementos[3]+0.00;
		        	$ks->a = 0.00;
		        	$material->ks = $ks;
		            break;

		        case 'Ns': // expoente specular
		        	$material->ns = $elementos[1]+0.00;
		            break;   
		        case 'Tr': // transparencia
		        	$material->tr = $elementos[1]+0.00;
		            break;   

		        default:
		            # code...
		            break;
		    }
		}
		$scene->material = $material;
	}	



	private function tratarWaveFront(&$scene) {
		$vertices = array();

		$triangles = array();
		$normals = array();
		$normals1 = array();
		$textures = array();
		$textures1 = array();
		$colors = array();
		$campos = explode(PHP_EOL, $scene->waveFront);
		foreach ($campos as $linha) {
			$linha = preg_replace('/\s\s+/', ' ', $linha);
		    $elementos = explode(' ', trim($linha));
		    switch ($elementos[0]) {
		        case 'v': // vertice
		            $vertice = new Vec3();
		            $vertice->x = $elementos[1]+0.00;
		            $vertice->y = $elementos[2]+0.00;
		            $vertice->z = $elementos[3]+0.00;
		            $scene->numberOfVertices++;
		            $vertices[] = $vertice;

		            $vn = new Vec3();
		            $vn->x = -1;
		            $vn->y = -1;
		            $vn->z = -1;
		            $normals1[] = $vn;

		            $vt = new Vec3();
		            $vt->x = -1;
		            $vt->y = -1;
		            $vt->z = -1;
		            $textures1[] = $vt;

		            break;
		        
		        case 'vn': // vertice normal
		            $vn = new Vec3();
		            $vn->x = $elementos[1]+0.00;
		            $vn->y = $elementos[2]+0.00;
		            $vn->z = $elementos[3]+0.00;
		            $normals[] = $vn;
		            $scene->numberOfNormals++;
		            break;

		        case 'vt': // vertice textures
		            $vt = new Vec3();
		            $vt->x = $elementos[1]+0.00;
		            $vt->y = $elementos[2]+0.00;
		            if (count($elementos)>3) {
		            	$vt->z = $elementos[3]+0.00;
		            } else {
		            	$vt->z = 0.00;
		            }	
		            $textures[] = $vt;
		            $scene->numberOfTextures++;
		            break;

		        case 'f': // face
		            $elementos = array_slice($elementos, 1);
		            $i=0;
		            $tipo = "";
		            foreach($elementos as $face) {
		            	$i++;
		            	$verticesFace = explode('/', trim($face));
		            	if ($i<4) { // v
			            	switch($i) {
			            		case 1:
			            			$v0 = $verticesFace[0];
			            			if (count($verticesFace)>1) {
			            			  $vt0 = $verticesFace[1]+0.00;
			            			} else {
			            				$vt0 = 0.00;
			            			}  
			            			if (count($verticesFace)>2) {
			            				$vn0 = $verticesFace[2]+0.00;
			            			} else {
			            				$vn0 = 0.00;
			            			}	
			            			break;
			            		case 2:
			            			$v1 = $verticesFace[0];
			            			if (count($verticesFace)>1) {
	  		            			  $vt1 = $verticesFace[1]+0.00;
	  		            			} else {
										$vt1 = 0.00;  		            				
	  		            			}  
			            			if (count($verticesFace)>2) {
			            			  $vn1 = $verticesFace[2]+0.00;
			            			} else {
									  $vn1 = 0.00;		            				
			            			}  
			            			break;
			            		case 3:
			            			$v2 = $verticesFace[0];
			            			if (count($verticesFace)>1) {
			            			  $vt2 = $verticesFace[1]+0.00;
			            			} else {
			            				$vt2 = 0.00;
			            			}  
			            			if (count($verticesFace)>2) {
			            			  $vn2 = $verticesFace[2]+0.00;
			            			} else {
			            				$vn2 = 0.00;
			            			}  

					                $t = new Triangle();
					                $t->v0 = $v0-1;
					                $t->v1 = $v1-1;
					                $t->v2 = $v2-1;

					                $t->vt0 = $vt0-1;
					                $t->vt1 = $vt1-1;
					                $t->vt2 = $vt2-1;

					                $t->vn0 = $vn0-1;
					                $t->vn1 = $vn1-1;
					                $t->vn2 = $vn2-1;

					                if ($t->vn0>=0) {
					                    $normals1[$t->v0] = $normals[$t->vn0];	
					                } 
					                if ($t->vn1>=0) {
					                	$normals1[$t->v1] = $normals[$t->vn1];		
					                }  
					                if ($t->vn2>=0) {
					                	$normals1[$t->v2] = $normals[$t->vn2];		
					                }

					                if ($t->vt0>=0) {
					                    $textures1[$t->v0] = $textures[$t->vt0];	
					                } 
					                if ($t->vt1>=0) {
					                	$textures1[$t->v1] = $textures[$t->vt1];		
					                }  
					                if ($t->vt2>=0) {
					                	$textures1[$t->v2] = $textures[$t->vt2];		
					                }
					                
					                $triangles[] = $t;
				            		$scene->numberOfTriangles++;
			            			break;
			            	}	
		            	} else {
			                $t = new Triangle();
			                $t->v0 = $triangles[$scene->numberOfTriangles-1]->v0;
			                $t->v1 = $triangles[$scene->numberOfTriangles-1]->v2;
			                $t->v2 = $verticesFace[0]-1;


			                $t->vt0 = $triangles[$scene->numberOfTriangles-1]->vt0;
			                $t->vt1 = $triangles[$scene->numberOfTriangles-1]->vt2;
			                if ( count($verticesFace)>1 ) {
			                  $t->vt2 = $verticesFace[1]-1;
			                } else {
			                	$t->vt2 = -1;
			                }  

			                $t->vn0 = $triangles[$scene->numberOfTriangles-1]->vn0;
			                $t->vn1 = $triangles[$scene->numberOfTriangles-1]->vn2;
			                if (count($verticesFace)>2) {
			                  $t->vn2 = $verticesFace[2]-1;
			                } else {
			                	$t->vn2 = -1;
			                }  

			                if ($t->vn0>=0) {
			                    $normals1[$t->v0] = $normals[$t->vn0];	
			                } 
			                if ($t->vn1>=0) {
			                	$normals1[$t->v1] = $normals[$t->vn1];		
			                }  
			                if ($t->vn2>=0) {
			                	$normals1[$t->v2] = $normals[$t->vn2];		
			                }

			                if ($t->vt0>=0) {
			                    $textures1[$t->v0] = $textures[$t->vt0];	
			                } 
			                if ($t->vt1>=0) {
			                	$textures1[$t->v1] = $textures[$t->vt1];		
			                }  
			                if ($t->vt2>=0) {
			                	$textures1[$t->v2] = $textures[$t->vt2];		
			                }

			                $triangles[] = $t;
		            		$scene->numberOfTriangles++;
		            	}
		            }
		            break;   
		        default:
		            # code...
		            break;
		    }
		}
		$scene->vertices = $vertices;
		$scene->triangles = $triangles;
		if (count($normals)>0) {
		  $scene->normals = $normals1;
		} else {
			$scene->normals = array();
		}  
		$scene->textures = $textures1;
		//$scene->textures1 = $textures;
		$scene->colors = $colors;
	}
}