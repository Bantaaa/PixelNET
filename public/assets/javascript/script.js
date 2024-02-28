const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});




<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    $(document).ready(function() {
        $('#searchForm').submit(function(e) {
            e.preventDefault();
            var keyword = $('#searchInput').val();

            $.ajax({
                type: 'GET',
                url: '/search/users',
                data: {
                    title_s: keyword
                },
                success: function(data) {
                    $('#userList').empty();
                    console.log(data);
                    data.forEach(function(user) {
                        var listItem = $('<li>').addClass('flex items-center')
                            .append($('<img>').attr('src', '{{ asset('images/2919906.png') }}')
                                .attr('alt', 'Profile Picture')
                                .addClass('h-8 w-8 rounded-full'))
                            .append($('<h4>').addClass('ml-3').text(user.Fname + ' ' + user.Lname))
                            .append($('<div>').addClass('ml-auto relative')
                                .append($('<form>').attr('action', '{{ route('user_follow', ['id' => $user->id]) }}')
                                    .attr('method', 'POST').addClass('inline')
                                    .append('@csrf')
                                    .append($('<button>').attr('type', 'submit')
                                        .addClass('bg-green-500 text-white px-2 py-1 rounded hover:bg-green-400')
                                        .text('Follow'))));
                        $('#userList').append(listItem);
                    });
                },
                error: function(error) {
                    console.error("Error during search:", error);
                }
                
            });
        });
    });




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
