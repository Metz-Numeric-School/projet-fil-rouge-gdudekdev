import IconPlus from "~/src/assets/icon/general/IconPlus";

const UserProfil: React.FC = () => (
  <section className="profil__user">
    <div className="profil__user-img-container">
      <form
        action="#"
        method="post"
        encType="multipart/form-data"
        className="profil__user-img-form"
      >
        <label htmlFor="user_img-form" className="profil__user-input-img">
          <IconPlus />
        </label>
        <input
          type="file"
          name="user_img-form"
          id="user_img-form"
          className="hidden"
        />
      </form>
      <div className="profil__user-img">
        <img src="app/src/assets/img/chat/dummyChatProfil.png" alt="Profil" />
      </div>
    </div>
    <div className="profil__user-info">
      <p>Gauthier, 23 ans</p>
    </div>
  </section>
);

export default UserProfil;
