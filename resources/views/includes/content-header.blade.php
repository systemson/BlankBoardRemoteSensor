<section class="content-header">
  <h1>
    {{ __($name . '.title') }}
  </h1>
  {!! breadcrumb(['name' => __($name . '.title'), 'route' => $name . '.index'], $after ?? [], $before) !!}
</section>