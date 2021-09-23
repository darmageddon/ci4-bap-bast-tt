(function($) {
    
    let win = $(window);
    let w = win.width();
    
    let body = $('body');
    let btn = $('#sidebarToggle');
    let sidebar = $('.sidebar');
    
    // Collapse on load
    
    if (win.width() < 992) {
        sidebar.addClass('collapsed');
    }
    
    sidebar.removeClass('mobile-hid');
    
    // Events
    
    btn.click(toggleSidebar);
    
    win.resize(function() {
        
        if (w==win.width()) {
            return;
        }
        
        w = win.width();
        
        if (w < 992 && !sidebar.hasClass('collapsed')) {
            toggleSidebar();
        } else if (w > 992 && sidebar.hasClass('collapsed')) {
            toggleSidebar();
        }
    });
    
    function toggleSidebar() { 
        
        if (win.width() < 992 || !sidebar.hasClass('collapsed')) {
            body.animate({'padding-left':'0'},100);
        }
        else if (win.width() > 992 && sidebar.hasClass('collapsed')) {
            body.animate({'padding-left':'14rem'},100);
        }
        
        if (!sidebar.hasClass('collapsed')) {
            sidebar.fadeOut(100,function(){
                btn.hide();
                sidebar.addClass('collapsed');
                btn.fadeIn(100);
            });
        }
        else {
            sidebar.removeClass('collapsed');
            sidebar.fadeIn(100);
        }
       
    }

    $(document).ready(function () {
        $('#table-kegiatan').DataTable({
            paging: true,
            ordering: false,
            info: false,
            lengthChange: false
        });

        $('#table-pegawai').DataTable({
            paging: true,
            ordering: false,
            info: false,
            lengthChange: false
        });

        $('#table-penyedia').DataTable({
            paging: true,
            ordering: false,
            info: false,
            lengthChange: false
        });

        $('#table-barang').DataTable({
            paging: true,
            ordering: false,
            info: false,
            lengthChange: false
        });

        $('#download').on('show.bs.modal', function (event) {
            const sender = $(event.relatedTarget);
            var id = sender.data('id');
            $('#title-kegiatan').text(sender.data('paket'));
            $('#link-bap').attr('href', '/kegiatan/' + id + '/surat/bap');
            $('#link-lampiran-bap').attr('href', '/kegiatan/' + id + '/surat/lampiran-bap');
            $('#link-bast').attr('href', '/kegiatan/' + id + '/surat/bast');
            $('#link-lampiran-bast').attr('href', '/kegiatan/' + id + '/surat/lampiran-bast');
            $('#link-tt').attr('href', '/kegiatan/' + id + '/surat/tanda-terima');
        });

        $('#input-sp-tanggal').datepicker({
            format: 'dd/mm/yyyy'
        }).on('changeDate', function(e) {
            $(this).datepicker('hide');
        });
        $('#input-bap-tanggal').datepicker({
            format: 'dd/mm/yyyy'
        }).on('changeDate', function(e) {
            $(this).datepicker('hide');
        });
        $('#input-bast-tanggal').datepicker({
            format: 'dd/mm/yyyy'
        }).on('changeDate', function(e) {
            $(this).datepicker('hide');
        });
        $('#input-tt-tanggal').datepicker({
            format: 'dd/mm/yyyy'
        }).on('changeDate', function(e) {
            $(this).datepicker('hide');
        });

        $('#input-penyedia').change(function() {
            const penyedia = $(this).val();
            const kegiatan = $('#dropdown-penyedia').data('kegiatan-id');
            $('#dropdown-penyedia').attr('href', '/penyedia/' + penyedia + '?kegiatan=' + kegiatan);
        });

        $('#input-unit').change(function() {
            const pegawai = $(this).val();
            const kegiatan = $('#dropdown-unit').data('kegiatan-id');
            $('#dropdown-unit').attr('href', '/pegawai/' + pegawai + '?kegiatan=' + kegiatan);
        });

        $('#input-kaprodi').change(function() {
            const pegawai = $(this).val();
            const kegiatan = $('#dropdown-kaprodi').data('kegiatan-id');
            $('#dropdown-kaprodi').attr('href', '/pegawai/' + pegawai + '?kegiatan=' + kegiatan);
        });
    });
})(jQuery)