<div class="offcanvas offcanvas-end" tabindex="-1" id="theme-settings-offcanvas">
    <div class="d-flex align-items-center bg-primary offcanvas-header p-3">
        <h5 class="m-0 text-white">Theme Settings</h5>
        <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body p-0">
        <div data-simplebar class="h-100">
            <div class="p-3">
                <h5 class="fs-16 fw-semibold mb-3">Color Scheme</h5>

                <div class="row">
                    <div class="col-6">
                        <div class="form-check mb-1">
                            <input class="form-check-input border-secondary" type="radio" name="data-bs-theme" id="layout-color-light" value="light">
                            <label class="form-check-label" for="layout-color-light">Light</label>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-check mb-1">
                            <input class="form-check-input border-secondary" type="radio" name="data-bs-theme" id="layout-color-dark" value="dark">
                            <label class="form-check-label" for="layout-color-dark">Dark</label>
                        </div>
                    </div>
                </div>

                <div id="layout-width">
                    <h5 class="fs-16 fw-semibold my-3">Layout Mode</h5>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-check mb-1">
                                <input class="form-check-input border-secondary" type="radio" name="data-layout-mode" id="layout-mode-fluid" value="fluid">
                                <label class="form-check-label" for="layout-mode-fluid">Fluid</label>
                            </div>
                        </div>

                        <div class="col-6">
                            <div id="layout-boxed">
                                <div class="form-check mb-1">
                                    <input class="form-check-input border-secondary" type="radio" name="data-layout-mode" id="layout-mode-boxed" value="boxed">
                                    <label class="form-check-label" for="layout-mode-boxed">Boxed</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <h5 class="fs-16 fw-semibold my-3">Topbar Color</h5>

                <div class="row">
                    <div class="col-6">
                        <div class="form-check mb-1">
                            <input class="form-check-input border-secondary" type="radio" name="data-topbar-color" id="topbar-color-light" value="light">
                            <label class="form-check-label" for="topbar-color-light">Light</label>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-check mb-1">
                            <input class="form-check-input border-secondary" type="radio" name="data-topbar-color" id="topbar-color-dark" value="dark">
                            <label class="form-check-label" for="topbar-color-dark">Dark</label>
                        </div>
                    </div>
                </div>

                <div>
                    <h5 class="fs-16 fw-semibold my-3">Menu Color</h5>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-check mb-1">
                                <input class="form-check-input border-secondary" type="radio" name="data-menu-color" id="leftbar-color-light" value="light">
                                <label class="form-check-label" for="leftbar-color-light">Light</label>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-check mb-1">
                                <input class="form-check-input border-secondary" type="radio" name="data-menu-color" id="leftbar-color-dark" value="dark">
                                <label class="form-check-label" for="leftbar-color-dark">Dark</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="sidebar-size">
                    <h5 class="fs-16 fw-semibold my-3">Sidebar Size</h5>

                    <div class="row gap-2">
                        <div class="col-12">
                            <div class="form-check mb-1">
                                <input class="form-check-input border-secondary" type="radio" name="data-sidenav-size" id="leftbar-size-default" value="default">
                                <label class="form-check-label" for="leftbar-size-default">Default</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-check mb-1">
                                <input class="form-check-input border-secondary" type="radio" name="data-sidenav-size" id="leftbar-size-compact" value="compact">
                                <label class="form-check-label" for="leftbar-size-compact">Compact</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-check mb-1">
                                <input class="form-check-input border-secondary" type="radio" name="data-sidenav-size" id="leftbar-size-small" value="condensed">
                                <label class="form-check-label" for="leftbar-size-small">Condensed</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-check mb-1">
                                <input class="form-check-input border-secondary" type="radio" name="data-sidenav-size" id="leftbar-size-full" value="full">
                                <label class="form-check-label" for="leftbar-size-full">Full Layout</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="layout-position">
                    <h5 class="fs-16 fw-semibold my-3">Layout Position</h5>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="data-layout-position" id="layout-position-fixed" value="fixed">
                                <label class="form-check-label" for="layout-position-fixed">Fixed</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="data-layout-position" id="layout-position-scrollable" value="scrollable">
                                <label class="form-check-label" for="layout-position-scrollable">Scrollable</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
