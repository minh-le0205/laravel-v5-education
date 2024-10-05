<div class="col-lg-6 form_grid">
    <h4 class="mb5">Gửi tin nhắn cho chúng tôi</h4>
    <p style="line-height: 25px">Bạn chỉ đầy đủ thông tin cá nhân và vấn đề trao đổi với ZendVN vào form bên dưới, sau
        khi nhận được thông tin này chúng tôi sẽ liên hệ với các bạn trong thời gian sớm nhất.</p>
    <form class="contact_form" id="contact_form" name="contact_form" action="{{ route('contact/save') }}" method="post"
        novalidate="novalidate"><input type="hidden" name="_token" value="GCvsHHXZVpwI5vNv74Y8BGhzNiYCEw3miAO9aMp7">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group"><label for="exampleInputName">Họ tên</label><input id="form_name" name="name"
                        class="form-control" type="text"></div>
            </div>
            <div class="col-sm-12">
                <div class="form-group"><label for="exampleInputEmail">Email</label><input id="form_email"
                        name="email" class="form-control email" type="email"></div>
            </div>
            <div class="col-sm-12">
                <div class="form-group"><label for="exampleInputPhone">Phone</label><input id="form_phone"
                        name="phone" class="form-control" type="text"></div>
            </div>
            <div class="col-sm-12">
                <div class="form-group"><label for="exampleInputEmail1">Lời nhắn</label>
                    <textarea id="form_message" name="message" class="form-control" rows="5"></textarea>
                </div>
                <div class="form-group ui_kit_button mb0"><button type="submit"
                        class="btn dbxshad btn-md btn-thm circle white">Gửi ngay</button></div>
            </div>
        </div>
    </form>
</div>
