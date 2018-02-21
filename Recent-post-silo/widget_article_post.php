<?php
/*
Plugin Name: Recent Post silo
Plugin URI: 
Description: Affiche les posts recents de la même catégorie, renforce la structure en silo.
Author: Linquant
Author URI: https://ewok-studio.fr
Version: 1.1
*/

class article_meme_cat_widget extends WP_Widget {


	public function __construct() {



		parent::__construct(

	 		'article_meme_cat_widget',

			'Recent Post silo',

			array( 'description' => __( 'Un widget pour afficher les articles récents de la même catégorie, renforce la struture en silo' ) )

		);



	}

 	public function form( $instance ) {

	}


	public function widget( $args, $instance ) {


		
		
		extract($args);

		echo $before_widget;

		echo $before_title; 
		echo "Articles récents"; 
		echo $after_title;

			global $post; 

			$categories = get_the_category($post->ID); 

			$idEnCours = $post->ID ;


        $args = array( 'numberposts' => 10, 'offset'=> 0, 'category' =>$categories[0] -> cat_ID);


        $myposts = get_posts( $args );



        echo "<ul>";

            foreach ( $myposts as $post ) {



                //condition pour eviter l'article en cours dans la liste des articles récents

                if ($idEnCours !=  $post->ID)	{
    


                    echo "<li>	<a href=\"".get_permalink()."\">".get_the_title()."</a></li>";


                }

            }

        echo "</ul>";
		echo "<br><br>";
		
		foreach((get_the_category()) as $cat) { echo '<h4 class ="widget-title"><a href="/'.$cat->category_nicename.'">Retrouver tous les articles sur '.strtolower($cat->cat_name).'</a></h4>'; }  
		

		echo $after_widget;
 
	}
	
	


}	

add_action( 'widgets_init', create_function( '', 'register_widget( "article_meme_cat_widget" );' ) );
