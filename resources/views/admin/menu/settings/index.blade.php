@extends('layout.app')

@section('css')
@endsection

@section('body')
    <x-page-heading title="Menu Settings Config" subtitle="Manage frontend settings" />
    <section class="section">
        <div class="d-flex justify-content-between gap-2">
            <div class="card col-md-5">
                <div class="card-header"><span class="h5">General Settings</span></div>
                <div class="card-body">
                    <form action="{{ route('menu.store') }}" method="post">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="basicInput" class="mb-2">Site Title</label>
                                <input type="text" class="form-control @error('site_title') is-invalid @enderror"
                                    id="basicInput" name="site_title" placeholder="Enter site title" />
                                @error('site_title')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="basicInput" class="mb-2">Site Description</label>
                                <textarea type="text" class="form-control @error('site_description') is-invalid @enderror" id="basicInput"
                                    name="site_description" placeholder="Enter site description"></textarea>
                                @error('site_description')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="basicInput" class="mb-2">Adresss</label>
                                <textarea type="text" class="form-control @error('address') is-invalid @enderror" id="basicInput" name="address"
                                    placeholder="Enter address"></textarea>
                                @error('address')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="basicInput" class="mb-2">Social Media</label>
                                <div class="form-group position-relative has-icon-left">
                                    <input type="text" class="form-control" placeholder="Input with icon left" />
                                    <div class="form-control-icon">
                                        <i class="bi bi-facebook"></i>
                                    </div>
                                </div>
                                <div class="form-group position-relative has-icon-left">
                                    <input type="text" class="form-control" placeholder="Input with icon left" />
                                    <div class="form-control-icon">
                                        <i class="bi bi-instagram"></i>
                                    </div>
                                </div>
                                <div class="form-group position-relative has-icon-left">
                                    <input type="text" class="form-control" placeholder="Input with icon left" />
                                    <div class="form-control-icon">
                                        <i class="bi bi-twitter"></i>
                                    </div>
                                </div>
                                <div class="form-group position-relative has-icon-left">
                                    <input type="text" class="form-control" placeholder="Input with icon left" />
                                    <div class="form-control-icon">
                                        <i class="bi bi-youtube"></i>
                                    </div>
                                </div>
                                @error('social_media')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="basicInput" class="mb-2">Facebook App ID</label>
                                <input type="text" class="form-control @error('facebook_id') is-invalid @enderror"
                                    id="basicInput" name="facebook_id" placeholder="Enter facebook id" />
                                @error('facebook_id')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="basicInput" class="mb-2">Twitter Username</label>
                                <input type="text" class="form-control @error('twitter_username') is-invalid @enderror"
                                    id="basicInput" name="twitter_username" placeholder="Enter twitter username" />
                                @error('twitter_username')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card col-md-7">
                <div class="card-header"><span class="h5">Visual Settings</span></div>
                <div class="card-body d-flex flex-column gap-2">
                    <form action="{{ route('menu.store') }}" method="post">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="site_logo" class="mb-2">Site Logo (.png)</label>
                                <input type="file" class="form-control" name="site_logo" />
                                @error('site_logo')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="favicon" class="mb-2">Favicon (.ico)</label>
                                <input type="file" class="form-control" name="favicon" />
                                @error('favicon')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="color" class="mb-2">Color</label>
                                <input type="color" name="color" class="form-control" />
                                @error('color')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-end gap-3 mt-3">
                                <a href="{{ route('menu.index') }}" class="btn btn-secondary">Back</a>
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('javascript')
@endsection
