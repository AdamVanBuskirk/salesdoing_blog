   
    jQuery(function($){
        $( document ).ready(function() {
        });
    });

    function joinNewsletter() {
        
        let email = jQuery("#email_for_newsletter").val();
        let adminUrl = jQuery("#admin_url").text();

        jQuery.ajax({
            type: "POST",
            dataType: "html",
            url: adminUrl,
            data: {
                email: email,
                action: "newsletter_signup"
            },
            success: function(data) {
                if (data.length) {
                    jQuery("#newsletter_form_strip").css("display", "none");
                    jQuery("#newsletter_success_strip").css("display", "");
                }
            }
        });
    }

    function registerVote(vote, postId) {

        let adminUrl = jQuery("#admin_url").text();
        let previousVote = localStorage.getItem("up_down_votes_" + postId);
        if (previousVote == null) {
            jQuery.ajax({
                type: "POST",
                dataType: "html",
                url: adminUrl,
                data: {
                    vote: vote,
                    postId: postId,
                    action: "register_vote"
                },
                success: function(data) {
                    if (data.length) {
                        if (data == "success") {
                            localStorage.setItem("up_down_votes_" + postId, vote);
                            let votes = Number(jQuery("#total-votes").html()) + vote;
                            let themeDirectory = jQuery("#theme_directory").text();
                            jQuery("#total-votes").html(votes);
                            /* change the arrow color based on vote */
                            if (vote == 1) {
                            jQuery("#up-vote-arrow").attr("src", themeDirectory + "/images/up-orange.png");
                            jQuery("#down-vote-arrow").attr("src", themeDirectory + "/images/down.png");
                            } else if (vote == -1) {
                            jQuery("#down-vote-arrow").attr("src", themeDirectory + "/images/down-orange.png");
                            jQuery("#up-vote-arrow").attr("src", themeDirectory + "/images/up.png");
                            }
                        }
                    }
                }
            });
        }
    }

