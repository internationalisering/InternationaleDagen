<?php
/**
 * @file beheerder_zoeken.php
 * @author Brend Simons
 * 
 * Pagina die te zien is wanneer de beheerder wil zoeken in alle tabellen.
 * 
 * @see Zoeken
 */
?>

<div id="page-wrapper" class="manage-wishes">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Search</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Search</label>
                <input class="form-control" id="search-text" oninput="return µ.search();">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Search in previous editions</label>
                <select class="form-control" id="search-previouseditions" onchange="return µ.search();">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row" style="padding: 15px;" id="results">
        
    </div>
</div>