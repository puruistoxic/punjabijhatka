<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Insight_Blog' ) ) {
    class Insight_Blog {

        public function __construct() {
        }

        public static function get_categories( $args = array() ) {
            $defaults = array(
                'all' => true,
            );
            $args     = wp_parse_args( $args, $defaults );
            $terms    = get_terms( array(
                                       'taxonomy'   => 'category',
                                   ) );
            $results  = array();

            if ( $args['all'] === true ) {
                $results['-1'] = esc_html__( 'All', 'tm-arden' );
            }

            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                foreach ( $terms as $term ) {
                    $results[ $term->slug ] = $term->name;
                }
            }

            return $results;
        }

        public static function get_tags( $args = array() ) {
            $defaults = array(
                'all' => true,
            );
            $args     = wp_parse_args( $args, $defaults );
            $terms    = get_terms( array(
                                       'taxonomy' => 'post_tag',
                                   ) );
            $results  = array();

            if ( $args['all'] === true ) {
                $results['-1'] = esc_html__( 'All', 'tm-arden' );
            }

            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                foreach ( $terms as $term ) {
                    $results[ $term->slug ] = $term->name;
                }
            }

            return $results;
        }
    }

    new Insight_Blog();
}
