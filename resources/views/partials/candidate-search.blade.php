<div class="hero-wrap js-fullheight">
    <div class="overlay"></div>
    <div class="container-fluid px-0">
        <div class="row d-md-flex no-gutters slider-text align-items-end js-fullheight justify-content-end">
            <img class="one-third align-self-end order-md-last img-fluid" src="frontend/images/undraw_work_time_lhoj.svg"
                alt="">
            <div class="one-forth d-flex align-items-center ftco-animate js-fullheight">
                <div class="text mt-5">
                    <p class="mb-4 mt-5 pt-5">We have <span class="number"
                            data-number="{{ $data['candidates'] }}">{{ $data['candidates'] }}</span> candidates looking
                        forward to
                        be hired!</p>
                    <h1 class="mb-5">Largets Job Site In The World</h1>
                    <div class="ftco-search">
                        <div class="row">
                            <div class="col-md-12 nav-link-wrap">
                                <div class="nav nav-pills text-center" id="v-pills-tab" role="tablist"
                                    aria-orientation="vertical">
                                    <a class="nav-link active mr-md-1" id="v-pills-1-tab" data-toggle="pill"
                                        href="#v-pills-1" role="tab" aria-controls="v-pills-1"
                                        aria-selected="true">Find an Employee</a>
                                </div>
                            </div>
                            <div class="col-md-12 tab-wrap">
                                <div class="tab-content p-4" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel"
                                        aria-labelledby="v-pills-nextgen-tab">
                                        <form action="{{ route('candidates.search') }}" method="GET"
                                            class="search-job">
                                            <div class="row no-gutters">
                                                <div class="col-md mr-md-2">
                                                    <div class="form-group">
                                                        <div class="form-field">
                                                            <div class="icon"><span class="icon-briefcase"></span>
                                                            </div>
                                                            <input type="text" name="skill" id="skill" required
                                                                class="form-control" placeholder="Skill">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md mr-md-2">
                                                    <div class="form-group">
                                                        <div class="form-field">
                                                            <div class="icon"><span class="icon-map-marker"></span>
                                                            </div>
                                                            <input type="text" name="address" class="form-control"
                                                                placeholder="Location">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md">
                                                    <div class="form-group">
                                                        <div class="form-field">
                                                            <button type="submit"
                                                                class="form-control btn btn-secondary">Search</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
