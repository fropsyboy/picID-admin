<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex no-block align-items-center">
                    <div>
                        {{ $title }}
                    </div>
                    <div class="ml-auto">
                        {{ $count }}
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="progress">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>