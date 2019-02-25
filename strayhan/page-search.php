<?
/**
* Template Name: Search Page
*
* A custom page template for the Advanced Search page.
* @package WordPress
* @subpackage Framework
* @since Framework 1.0
*/

get_header(); ?>

<div class="container">

    <div class="row page-content">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-area">

            <div class="contents clear">

                <? if(have_posts()) while (have_posts()) : the_post(); ?>

                    <h1>Search Properties</h1>

                    <form id="advanced-search" class="advanced-search" action="<? bloginfo('url'); ?>/listings/" method="GET" name="advanced-search">

                        <div class="row search-content">

                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 search-left">

                                <div class="contents clear">

                                    <div id="type">
                                        <h3>Type of Listings:</h3>
                                        <input name="priority" type="radio" value="1" />Cameron's Listings Only
                                        <input checked="checked" name="priority" type="radio" value="" /> Include All MLS Listings
                                    </div>

                                    <h3>Search by Details:</h3>
                                    <select class="advsearch-cat" name="category">
                                        <option value="">--Select Category--</option>
                                        <option value="1">Home</option>
                                        <option value="2">Townhouse</option>
                                        <option value="3">Condominium</option>
                                        <option value="5">Residential Land</option>
                                        <option value="12">Commercial Sales</option>
                                        <option value="11">Farms &amp; Acreage / Commercial Land</option>
                                        <option value="13">Commercial Lease</option>
                                    </select>

                                    <strong>Price</strong>
                                    <select id="qs-price" class="advsearch-price" name="current_price">
                                        <option value="">--Select One--</option>
                                        <option value="0-49999">$0-$49,999</option>
                                        <option value="50000-99999">$50,000 - $99,999</option>
                                        <option value="100000-149999">$100,000 - $149,999</option>
                                        <option value="150000-199999">$150,000 - $199,999</option>
                                        <option value="200000-249999">$200,000 - $249,999</option>
                                        <option value="250000-499999">$250,000 - $499,999</option>
                                        <option value="500000-749999">$500,000 - $749,999</option>
                                        <option value="750000-999999">$750,000 - $999,999</option>
                                        <option value="1000000-1499999">$1 Million - $1.49 Million</option>
                                        <option value="1500000-1999999">$1.5 Million - $1.9 Million</option>
                                        <option value="2000000-2499999">$2 Million - $2.49 Million</option>
                                        <option value="2500000-2999999">$2.5 Million - $2.9 Million</option>
                                        <option value="3000000-999999999">$3 million +</option>
                                    </select>

                                    <strong>Beds</strong>
                                    <select class="advsearch-beds" name="bedrooms">
                                        <option value="">--Select One--</option>
                                        <option value="1">1+</option>
                                        <option value="2">2+</option>
                                        <option value="3">3+</option>
                                        <option value="4">4+</option>
                                        <option value="5">5+</option>
                                        <option value="6">6+</option>
                                        <option value="7">7+</option>
                                        <option value="8">8+</option>
                                    </select>

                                    <strong>Baths</strong>
                                    <select class="advsearch-baths" name="baths_full">
                                        <option value="">--Select One--</option>
                                        <option value="1">1+</option>
                                        <option value="2">2+</option>
                                        <option value="3">3+</option>
                                        <option value="4">4+</option>
                                        <option value="5">5+</option>
                                        <option value="6">6+</option>
                                        <option value="7">7+</option>
                                        <option value="8">8+</option>
                                    </select>

                                    <strong>MLS #</strong>
                                    <input class="advsearch-mls" name="mls_acct" type="text" />

                                </div>

                            </div> <!--/SEARCH-LEFT-->

                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 search-right">

                                <div class="contents clear">

                                    <h3>Search by Location:</h3>
                                    <strong>Area</strong>
                                    <select class="advsearch-area" name="area">
                                        <option value="">--Select One--</option>
                                        <option value="E17 or E18">30A</option>
                                        <option value="E27">Bay County</option>
                                        <option value="E25">Crestview Area</option>
                                        <option value="E14">Destin</option>
                                        <option value="E03">Don Bishop to Churchill Bayou</option>
                                        <option value="E12">Fort Walton Beach</option>
                                        <option value="E20">Freeport</option>
                                        <option value="E15">Miramar / Sandestin Resort</option>
                                        <option value="E11">Navarre / Gulf Breeze</option>
                                        <option value="E13">Niceville</option>
                                        <option value="E10">North Santa Rosa County</option>
                                        <option value="E23">North Walton County</option>
                                        <option value="E08">Pensacola Area</option>
                                        <option value="E19">Point Washington</option>
                                        <option value="E16 or E17">Santa Rosa</option>
                                        <option value="E18">South Walton East</option>
                                        <option value="E15">South Walton West</option>
                                        <option value="E30">Other Counties</option>
                                    </select>

                                    <strong>Subdivision/Neighborhood</strong>
                                    <input class="advsearch-subdivision" name="subdivision" type="text" />

                                    <strong>City</strong>
                                    <input class="advsearch-city" name="city" type="text" />

                                    <strong>Zip Code</strong>
                                    <input class="advsearch-zip" name="zip" type="text" />

                                    <h3>Waterfront/Waterview</h3>
                                    <input class="advsearch-waterfront" name="ftr_waterfront" type="checkbox" value="Bay or Bayou or Canal or Creek or Gulf or Gulf/Pass or Harbor or Intracoastal or Lake or Lagoon or Other or Pond or Project or Riparian or River or Shore or Sound or Stream or Unit" /> Waterfront Properties

                                    <input class="advsearch-waterview" name="ftr_waterview" type="checkbox" value="Bay or Bayou or Canal or Creek or Gulf or Gulf/Pass or Harbor or Intracoastal Waterway or Lake or Lagoon or River or Sound or Stream or Unit" /> Waterview Properties

                                    <h3>Sort Results by:</h3>
                                    <strong>Sort Order</strong>
                                    <select class="advsearch-sort" name="_orderby">
                                        <option value="current_price desc">Price - High to Low</option>
                                        <option value="current_price asc">Price - Low to High</option>
                                        <option value="bedrooms desc">Bedrooms - High to Low</option>
                                        <option value="bedrooms asc">Bedrooms - Low to High</option>
                                        <option value="city">City</option>
                                    </select>

                                </div>

                            </div> <!--/SEARCH-RIGHT-->

                        </div> <!--/ROW-->

                        <div class="row search-content">

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 search-bottom">

                                <input class="btn" title="Start Search" type="submit" value="Search" />
                                <input class="btn" title="Reset Form" type="reset" value="Reset" />

                            </div>

                        </div>

                    </form>
                    
                <? endwhile; ?>

            </div> <!--/CONTENTS-->

        </div> <!--/ROW-->

    </div> <!--/PAGE-CONTENT-->

</div> <!--/CONTAINER-->

<? get_footer(); ?>