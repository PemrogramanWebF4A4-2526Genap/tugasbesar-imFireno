    <script>
        // Profile Dropdown Logic
        const profileButton = document.getElementById('profileButton');
        const profileMenu = document.getElementById('profileMenu');
        
        if (profileButton && profileMenu) {
            profileButton.addEventListener('click', (e) => {
                e.stopPropagation();
                profileMenu.classList.toggle('hidden');
            });
            
            document.addEventListener('click', function(e) {
                if (!profileButton.contains(e.target) && !profileMenu.contains(e.target)) {
                    profileMenu.classList.add('hidden');
                }
            });
        }
    </script>