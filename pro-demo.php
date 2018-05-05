<?php
add_filter( 'wauc_auction_display_settings', function ( $settings ) {
    $settings = array_merge($settings,array(
        array(
            'title'           => __( 'Do not display auctions on shop page (Pro)', 'wauc' ),
            'desc'            => __( 'Check this if you do not want to show auctions in shop page', 'wauc' ),
            'id'              => '',
            'default'         => 'yes',
            'type'            => 'checkbox',
            'checkboxgroup'   => 'start',
        ),
        array(
            'title'           => __( 'Do not display auctions on category page (Pro)', 'wauc' ),
            'desc'            => __( 'Check this if you do not want to show auctions in category page', 'wauc' ),
            'id'              => '',
            'default'         => 'yes',
            'type'            => 'checkbox',
            'checkboxgroup'   => 'start',
        ),
        array(
            'title'           => __( 'Do not display auctions on tag page (Pro)', 'wauc' ),
            'desc'            => __( 'Check this if you do not want to show auctions in tag page', 'wauc' ),
            'id'              => '',
            'default'         => 'yes',
            'type'            => 'checkbox',
            'checkboxgroup'   => 'start',
        )
    ) );

    return $settings;
})
;
//Fake auction
add_filter( 'wauc_auction_report_tabs', 'wauc_demo_fake_auction_tab' );
function wauc_demo_fake_auction_tab( $tabs ) {
    $tabs['fake_auction_demo'] = array(
        'label' => __( 'Fake Auction', 'wauc' ),
        'desc' => __( 'List of fake bids and bidders and the auctions where these bid are places (Pro)', 'wauc' ),
        'callback' => function() {
            _e('<h3 class="text-center">Will be available in pro version</h3>','wauc' );
        }
    );
    return $tabs;
}

//demo widget
class WAUC_Auction_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'wauc_auction_widget_demo', // Base ID
            __( 'WooCommerce Auction widget (Pro)', 'wauc' ), // Name
            array( 'description' => __( 'Auction widget for WooCommerce', 'wauc' ), ) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance, $return = false ) {
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        ?>
        <p>
            <label><?php _e( esc_attr( 'Title:' ) ); ?></label>
            <input class="widefat" type="text">
        </p>
        <?php
        //display what ; product list of current products, past products , upcoming products, featured products
        ?>
        <p>
            <label for=""><?php _e( esc_attr( 'Number of items to display:' ) ); ?></label>
            <input class="widefat" type="number">
        </p>
        <p>
        <label><?php _e( esc_attr( 'Section(s) to display:' ) ); ?></label>
        <?php
        $sections = array(
            'current_auctions' => 'Current Auctions',
            'completed_auctions' => 'Completed Auctions',
            'upcoming_auctions' => 'Upcoming Auctions'
        );

        foreach( $sections as $section_name => $val ) {
            ?>
            <p>
                <label>
                    <input class="widefat" type="checkbox"> <?php echo $val; ?>
                </label>
            </p>
            <?php
        }
        ?>
        </p>
        <p>
            <?php
            $display_styles = array(
                'normal' => 'Normal',
                'accordion' => 'Accordion',
                'tabs' => 'Tabs'
            );
            ?>
            <select>
                <?php
                foreach( $display_styles as $style => $val ) {
                    ?>
                    <option class="widefat"><?php echo $val; ?></option>
                    <?php
                }
                ?>
            </select>
        </p>
        <?php

        //style ; tab, accordion, normal
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        return $instance;
    }

} // class Foo_Widget

if( phpversion() > '5.3' ) {
    add_action( 'widgets_init', function(){
        register_widget( 'WAUC_Auction_Widget' );
    });
} else {
    add_action('widgets_init',
        create_function('', 'return register_widget("WAUC_Auction_Widget");')
    );
}

