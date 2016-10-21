<!-- REQUIRED JS SCRIPTS -->


<!-- jQuery 2.1.4 -->
<!--script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script-->

<!-- jQuery 3.1.0 -->
<script src="{{ asset('/bower_components/jquery/dist/jquery.js') }}"></script>

<!-- Vue -->
<script src="{{ asset('/bower_components/vue/dist/vue.js') }}"></script>

<!-- Vue Resource -->
<script src="{{ asset('/bower_components/vue-resource/dist/vue-resource.js') }}"></script>
<script>
	Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#_token').getAttribute('value');
</script>

<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('/bower_components/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/js/app.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/app.path.js') }}" type="text/javascript"></script>

<!-- iCheck 1.0.1 -->
<script src="{{  asset('/plugins/iCheck/icheck.min.js') }}"></script>

<!-- Bootbox -->
<script src="{{ asset('/js/bootbox.min.js') }}" type="text/javascript"></script>

<!-- DataTable -->
<script src="{{ asset('/plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>

<script src="{{ asset('/plugins/datatables/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>

<!-- Troast -->
<script src="{{ asset('/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js') }}" type="text/javascript"></script>

<!-- Alphanum -->
<script src="{{ asset('/bower_components/jquery-alphanum/jquery.alphanum.js') }}" type="text/javascript"></script>

<!-- Input Mask -->
<script src="{{ asset('/plugins/input-mask/jquery.inputmask.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/input-mask/jquery.inputmask.date.extensions.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/input-mask/jquery.inputmask.extensions.js') }}" type="text/javascript"></script>


<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->