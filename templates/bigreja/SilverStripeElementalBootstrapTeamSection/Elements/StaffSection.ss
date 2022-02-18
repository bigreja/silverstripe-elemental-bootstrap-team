<% include Syntro\SilverStripeElementalBaseitems\ContentBlock %>

<div class="row justify-content-center text-center">
    <% loop StaffMembers %>
        <div class="{$ElementName}__staffer col-12 col-sm-6 col-md-4 col-xl-3 d-flex flex-column align-items-center my-3">
            <div class="{$ElementName}__staffer-image px-5">
                <img src="$Image.URL" alt="$Title" class="w-75 img-fluid rounded-circle shadow">
            </div>
            <h3 class="{$ElementName}__staffer-title mt-4">$Title</h3>
            <% if Position %>
                <small class="{$ElementName}__staffer-position text-uppercase"><strong>$Position</strong></small>
            <% end_if %>
            <p class="{$ElementName}__staffer-description mt-3 px-3">$Description</p>
        </div>
    <% end_loop %>
</div>
