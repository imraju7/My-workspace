    <div class="row">
        <div class="col-md-12 tab-wrap">
            <div class="tab-content p-4" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
                    <form action="{{ route('jobs.search') }}" method="GET" class="search-job">
                        <div class="row no-gutters">
                            <div class="col-md mr-md-2">
                                <div class="form-group">
                                    <div class="form-field">
                                        <div class="icon"><span class="icon-briefcase"></span>
                                        </div>
                                        <input type="text" name="title" id="title" required
                                            class="form-control" value="{{ request('title') }}"
                                            placeholder="eg. Garphics">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md mr-md-2">
                                <div class="form-group">
                                    <div class="form-field">
                                        <div class="select-wrap">
                                            <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                            <select name="job_type" id="job_type" class="form-control">
                                                <option value="">Type</option>
                                                <option @if (request('job_type') == 'full-time') selected @endif
                                                    value="full-time">Full Time</option>
                                                <option @if (request('job_type') == 'part-time') selected @endif
                                                    value="part-time">Part Time</option>
                                                <option @if (request('job_type') == 'casual') selected @endif
                                                    value="casual">Casual</option>
                                                <option @if (request('job_type') == 'contract') selected @endif
                                                    value="contract">Contract</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md mr-md-2">
                                <div class="form-group">
                                    <div class="form-field">
                                        <div class="icon"><span class="icon-map-marker"></span>
                                        </div>
                                        <input type="text" name="address" value="{{ request('address') }}"
                                            class="form-control" placeholder="Location">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <div class="form-field">
                                        <button type="submit" class="form-control btn btn-secondary">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
