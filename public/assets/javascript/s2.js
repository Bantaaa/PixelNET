<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>



                    document.addEventListener("DOMContentLoaded", function() {
                        var notificationToggle = document.getElementById("notification-toggle");
                        var notificationDropdown = document.getElementById("notification-dropdown");

                        notificationToggle.addEventListener("click", function() {
                            notificationDropdown.classList.toggle("hidden");
                        });

                        document.addEventListener("click", function(event) {
                            if (!notificationToggle.contains(event.target) && !notificationDropdown.contains(event.target)) {
                                notificationDropdown.classList.add("hidden");
                            }
                        });
                    });
