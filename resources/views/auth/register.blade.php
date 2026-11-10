{{--
    Compatibility wrapper for projects referencing 'auth.register'.
    Delegates to the active BlatUI signup page variant.
--}}
@include(config('blatui.pages.auth.register', 'pages.auth.signup-01'))
