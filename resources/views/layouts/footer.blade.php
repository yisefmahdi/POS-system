<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const profileBtn = document.getElementById('profileBtn');
    const profileMenu = document.getElementById('profileMenu');

    // Toggle menu
    profileBtn.onclick = () => {
        profileMenu.classList.toggle("hidden");
    };

    // اغلاق القائمة عند الضغط خارجها
    document.addEventListener("click", function(e) {
        if (!profileBtn.contains(e.target) && !profileMenu.contains(e.target)) {
            profileMenu.classList.add("hidden");
        }
    });
</script>

<script>
    // Toggle sidebar on mobile
    const menuBtn = document.getElementById('menuBtn');
    const sidebar = document.getElementById('sidebar');

    menuBtn.onclick = () => {
        sidebar.classList.toggle("translate-x-0");
        sidebar.classList.toggle("-translate-x-full");
    };
</script>


    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif
@yield('js')
