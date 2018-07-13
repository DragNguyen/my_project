<div class="ui basic modal modal-confirm">
    <div class="ui icon header">
        <i class="archive icon"></i>
        Archive Old Messages
    </div>
    <div class="content">
        <p>Your inbox is getting full, would you like us to enable automatic archiving of old messages?</p>
    </div>
    <div class="actions">
        <div class="ui red basic cancel inverted button">
            <i class="remove icon"></i>
            No
        </div>
        <div class="ui green ok inverted button">
            <i class="checkmark icon"></i>
            Yes
        </div>
    </div>
</div>

<style>
    .ui.confirm {
        text-align: center;
        vertical-align: middle;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
    }
    .ui.confirm .contents {
        color: white;
        width: 50%;
        height: 3em;
    }
</style>