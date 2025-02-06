<?php
/**
 * Plugin Name:       My Audio Block
 * Description:       A custom audio player for Elementor.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       my-audio-block
 *
 * @package           create-block
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Function to enqueue frontend scripts
function my_audio_block_enqueue_frontend_assets() {
    wp_enqueue_script('wavesurfer', 'https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/7.5.0/wavesurfer.min.js', array(), '7.5.0', true);
    wp_enqueue_script('my-audio-block-elementor', plugins_url('elementor-audio.js', __FILE__), array('jquery', 'wavesurfer'), '1.0', true);
}

// Function to enqueue styles
function my_audio_block_enqueue_styles() {
    wp_enqueue_style('my-audio-block-styles', plugins_url('src/stylesheet.css', __FILE__));
}

// Hook your functions to the appropriate WordPress hooks
add_action('wp_enqueue_scripts', 'my_audio_block_enqueue_frontend_assets');
add_action('wp_enqueue_scripts', 'my_audio_block_enqueue_styles');

// Register the widget with Elementor after Elementor is loaded
function register_my_audio_block_widget($widgets_manager) {
    if (class_exists('\Elementor\Widget_Base')) {
        class Elementor_Audio_Widget extends \Elementor\Widget_Base {
            public function get_name() {
                return 'audio-widget';
            }

            public function get_title() {
                return esc_html__('Audio Player', 'my-audio-block');
            }

            public function get_icon() {
                return 'eicon-play';
            }

            protected function _register_controls() {
                $this->start_controls_section(
                    'content_section',
                    [
                        'label' => esc_html__( 'Content', 'my-audio-block' ),
                        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    ]
                );

                $this->add_control(
                    'audio',
                    [
                        'label' => esc_html__( 'Choose Audio', 'my-audio-block' ),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'media_type' => 'audio',
                    ]
                );

                $this->end_controls_section();
            }

            protected function render() {
                $settings = $this->get_settings_for_display();
            
                // Check if we're in the Elementor editor.
                if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
                    // Display the file name in the Elementor editor.
                    if ( ! empty( $settings['audio']['url'] ) ) {
                        $file_name = basename( $settings['audio']['url'] );
                        echo '<p>Loaded Audio File: ' . esc_html( $file_name ) . '</p>';
                    }
                }
            
                // This part is common for both the Elementor editor and the live page.
                if ( ! empty( $settings['audio']['url'] ) ) {
                    echo '<div class="audio-player-container">';
                    echo '  <div class="waveform-play-pause-container">';
                    echo '      <button class="waveform-play-pause"><i class="fa fa-play"></i></button>';
                    echo '  </div>';
                    echo '  <div class="waveform-container" data-audio-url="' . esc_attr( $settings['audio']['url'] ) . '"></div>';
                    echo '</div>';
                }
            }
            
        }

        $widgets_manager->register(new \Elementor_Audio_Widget());
    }
}

if ( did_action( 'elementor/loaded' ) ) {
    add_action('elementor/widgets/widgets_registered', 'register_my_audio_block_widget');
}
