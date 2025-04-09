<?php include('includes/header.php'); ?>


<!-- Products -->
<div class="products py-5">
    <div class="container">
        <div class="d-flex justify-content-between">
            <div>
                <h2>Explore products</h2>
                <p>45.960 products available</p>
            </div>
            <div>
                <form action="#">
                    <select name="filter" id="filter" class="form-control">
                        <option value="">Filter products &darr;</option>
                    </select>
                </form>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card" style="width: 18rem;">
                    <img src="https://hhstsyoejx.gjirafa.net/gj50/img/204546/thumb/0.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Product title</h5>
                        <p class="card-text">2450.50 &euro;</p>
                        <a href="#" class="btn btn-outline-secondary">View product</a>
                    </div>
                </div> <!-- ./card -->
            </div> <!-- ./col -->
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card" style="width: 18rem;">
                    <img src="https://hhstsyoejx.gjirafa.net/gj50/img/204546/thumb/0.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Product title</h5>
                        <p class="card-text">
                            <strike>2450.50 &euro;</strike>
                            <span class="badge bg-danger">10%</span>
                            <span>2120 &euro;</span>
                        </p>
                        <a href="#" class="btn btn-outline-secondary">View product</a>
                    </div>
                </div> <!-- ./card -->
            </div> <!-- ./col -->
        </div> <!-- ./row -->
    </div>
</div>


<?php include('includes/footer.php'); ?>