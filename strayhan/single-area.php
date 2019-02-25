<?
/**
 * The Template for displaying all single posts.
 * @package WordPress
 * @subpackage Framework
 * @since Framework 1.0
 */

get_header();

// CHECK LAUNCHPAD FOR OLYMPUS FORMAT
if(LPFORMAT == 'list') {
    $format = 'list-format';
    $classes = 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
} elseif(LPFORMAT == 'grid') {
    $format = 'grid-format';
    $classes = 'col-xs-12 col-sm-6 col-md-3 col-lg-3';
} else {
    $format = 'list-format';
    $classes = 'col-sm-12 col-md-12 col-lg-12';
}

// CHECK LAUNCHPAD FOR OLYMPUS PAGE TITLE
if(LPTITLE == '') {
    $page_title = 'Properties';
} else {
    $page_title = LPTITLE;
}
?>

<div class="container">

    <div class="row page-content">

        <div class="col-xs-12 col-sm-10 content-area">

		    <? if(have_posts()) while (have_posts()) : the_post(); ?>

		        <div class="contents clear">

		            <h1><? the_title(); ?></h1>

		             <?php if ( has_post_thumbnail() ): ?>

		            	<div class="text-center thumbnail">
			        		<? the_post_thumbnail(); ?>
			        	</div>

		            <?php endif ?>

		            <? the_content(); ?>

                </div>

	        <? endwhile; ?>

        </div>

    </div> <!--/PAGE-CONTENT-->

    <div class="property-list">
        <div class="row listing-row">
        <?php
        //we want a db connection
        $db = mysqli_connect('qs1826.pair.com', 'waltonch_19_r', 'S6BqP5GU', 'waltonch_cysyrets');
        //figure out what props to pull based on the page title
        //build a query for neighborhood & city based on title
        $title = get_the_title();
        $query = "SELECT * FROM listings WHERE data_id = 'E' AND (city LIKE '%$title%' OR subdivision LIKE '%$title%') AND category IN (1, 2, 3) ORDER BY RAND() LIMIT 8";
        $props = $db->query($query);
        //echo '<pre>', print_r($props), '</pre>';
        //loop the props
        if($props->num_rows > 0):
        while($row = $props->fetch_object()):
            $photos = explode(',', $row->udf_photo0);

            if($photos) {
                $thumbnail = $photos[0];
            } else {
                $thumbnail = plugins_url().'/launchpad/images/graphic_no_property.jpg';
            }

            switch ($row->category) {
                case '1': $type = 'Home'; break;
                case '2': $type = 'Townhome'; break;
                case '3': $type = 'Condominium'; break;
                case '4': $type = 'Timeshare'; break;
                case '5': $type = 'Residential Land'; break;
                case '6': case '12': $type = 'Commercial Sale'; break;
                case '7': $type = 'Commercial Land'; break;
                case '8': case '13': $type = 'Commercial Lease'; break;
                case '9': $type = 'Rental'; break;
                case '10': $type = 'Auction'; break;
                case '11': $type = 'Farm / Acreage'; break;
                default: $type = 'Property'; break;
            }
            ?>
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 property-list-item">
                <a class="item-container" href="<?=site_url()?>/listings/<?=$row->unique_id?>">
                    <div class="contents clear">
                        <div class="property-list-item-thumbnail-container">
                            <div class="property-list-item-thumbnail" style="background-image: url('<?=$thumbnail?>');"></div>
                        </div>
                        <div class="property-info">
                            <span class="center property-item-header">$<?=number_format($row->current_price)?></span>
                            <span class="center property-item-subheader"><?=$row->city?></span>
                            <table class="property-stats">
                                <tbody>
                                    <tr>
                                        <td>MLS #:</td>
                                        <td><?=$row->mls_acct?></td>
                                    </tr>
                                    <tr>
                                        <td>Type:</td>
                                        <td><?=$type?></td>
                                    </tr>
                                    <tr>
                                        <td>Beds:</td>
                                        <td>
                                        <?=$row->bedrooms?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Baths:</td>
                                        <td>
                                        <?=$row->baths_full?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Sq.Ft.:</td>
                                        <td>
                                        <?=number_format($row->tot_heat_sqft)?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <span class="center disclaimer">Listed by <?=$row->lo_name?></span>
                        </div>
                    </div>
                </a>
            </div>
        <?php endwhile; ?>
    </div><!--/properties-->
    </div><!--/property-list-->

    <a class="btn submit" href="<?=site_url()?>/listings/?subdivision=<?=get_the_title()?>">View More Listings</a>

    <? else:
        //this will keep the results area from showing if there are no props
    endif;
    ?>

</div> <!--/CONTAINER-->

<? get_footer(); ?>
