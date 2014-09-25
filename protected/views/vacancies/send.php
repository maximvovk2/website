<form class="send-cv" action="/vacancies/sendcv" method="post" enctype="multipart/form-data">
    <h1>vacancy request</h1>
    <!-- <span class="job-title"></span> -->
    <div class="alert" style="display:none;"></div>
    <div class="success" style="display:none;"></div>
    <div class="row-holder">
        <div class="form-row">
            <label>your name</label>
            <input type="text" name="name"/>
        </div>
        <div class="form-row">
            <label>e-mail</label>
            <input type="text" name="email"/>
        </div>
        <div class="form-row msg">
            <label>comments</label>
            <textarea name="message"></textarea>
        </div>
        <div class="form-row">
            <div class="add-resume">
                <div class="button">
                    <span>add resume</span>
                    <input type="file" name="cv" class="custom-file"/>
                </div>
                <span class="name"></span>
            </div>
        </div>
    </div>
    <input type="hidden" name="jobid" value="<?php echo $_GET['id']; ?>"/>

    <div class="submit-holder">
        <input type="submit" value="Send"/>
    </div>
</form>