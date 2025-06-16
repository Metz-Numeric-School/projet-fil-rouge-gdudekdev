import React, { useEffect, useState } from "react";
import FormSubmit from "~/components/main/button/FormSubmit/FormSubmit";
import { useApi } from "~/hooks/useApi";

interface Preferences {
  preferences_id: number;
  preferences_name: string;
}
interface UserPreferences {
  preferences_id: number;
}
interface UserInfo {
  accounts_fullname: string;
  accounts_birthday: string;
  accounts_phone: string;
  accounts_email: string;
}

interface InfoItemProps {
  title: string;
  name: keyof UserInfo;
  value: string;
  type: string;
  handleChange: (e: React.ChangeEvent<HTMLInputElement>) => void;
}

const InfoItem: React.FC<InfoItemProps> = ({
  title,
  name,
  value,
  type,
  handleChange,
}) => (
  <div className="info__nom-item">
    <div className="info__nom-item-content">
      <div className="info__nom-item-title">
        <p>{title}</p>
      </div>
      <div className="info__nom-item-value">
        <input
          type={type}
          name={name}
          value={value}
          onChange={handleChange}
          className="info__form-txt"
        />
      </div>
    </div>
  </div>
);

interface PreferencesItemProps {
  title: string;
  preferences: Preferences[] | null;
  userPreferences: UserPreferences[] | null;
  onChange: (updated: UserPreferences[]) => void;
}

const PreferencesItem: React.FC<PreferencesItemProps> = ({
  title,
  preferences,
  userPreferences,
  onChange,
}) => {
  const selectedIds =
    userPreferences?.map((p) => p.preferences_id) ?? [];

  const togglePreference = (id: number) => {
    const updated = selectedIds.includes(id)
      ? selectedIds.filter((i) => i !== id)
      : [...selectedIds, id];

    onChange(updated.map((id) => ({ preferences_id: id })));
  };

  return (
    <div className="info__nom-item">
      <div className="info__nom-item-content">
        <div className="info__nom-item-title">
          <p>{title}</p>
        </div>
        <div className="info__nom-item-value flex flex-wrap gap-2">
          {!preferences ? (
            <p>Chargement des préférences ...</p>
          ) : (
            preferences.map((pref) => (
              <button
                key={pref.preferences_id}
                type="button"
                className={`px-3 py-1 rounded-full border ${
                  selectedIds.includes(pref.preferences_id)
                    ? "bg-[var(--maincolor-dark)] text-white"
                    : "bg-white text-[var(--maincolor-dark)]"
                }`}
                onClick={() => togglePreference(pref.preferences_id)}
              >
                {pref.preferences_name}
              </button>
            ))
          )}
        </div>
      </div>
    </div>
  );
};

const Info = () => {
  const { apiQuery } = useApi();
  const [isChanged, setIsChanged] = useState(false);
  const [userInfo, setUserInfo] = useState<UserInfo | null>(null);
  const [preferences, setPreferences] = useState<Preferences[] | null>(null);
  const [userPreferences, setUserPreferences] = useState<UserPreferences[] | null>(null);

  useEffect(() => {
    async function fetchUserInfo() {
      try {
        const result = await apiQuery("me");
        if (result?.response) {
          setUserInfo(result.response.accounts_info);
          setPreferences(result.response.preferences);
          setUserPreferences(result.response.accounts_preferences);
        }
      } catch (error) {
        console.error("Erreur lors du chargement :", error);
      }
    }

    fetchUserInfo();
  }, []);

  const handleInfoChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const { name, value } = e.target;
    setUserInfo((prev) =>
      prev ? { ...prev, [name]: value } : prev
    );
    setIsChanged(true);
  };

  const handlePreferencesChange = (updated: UserPreferences[]) => {
    setUserPreferences(updated);
    setIsChanged(true);
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();

    try {
      const result = await apiQuery("me/update", {
        userInfo,
        userPreferences,
      });

      if (result?.status === 200) {
        console.log("Informations mises à jour !");
      }
    } catch (error) {
      console.error("Erreur lors de la mise à jour :", error);
    }

    setIsChanged(false);
  };

  const infoItems: { title: string; name: keyof UserInfo; type: string }[] = [
    { title: "Nom complet", name: "accounts_fullname", type: "text" },
    { title: "Date de naissance", name: "accounts_birthday", type: "date" },
    { title: "Mobile", name: "accounts_phone", type: "text" },
    { title: "Email", name: "accounts_email", type: "text" },
  ];
// TODO essayer de faire le stockage des photos de profil et de pouvoir les ranger proprement a la racine du projet
  return (
    <div className="info">
      <h2>Informations personnelles</h2>
      <div className="info__user">
        <div className="info__user-img">
          <img src="#" alt="" />
        </div>
      </div>
      {!userInfo ? (
        <p>Chargement des données ...</p>
      ) : (
        <form onSubmit={handleSubmit}>
          <div className="info__nom-content">
            {infoItems.map((item) => (
              <InfoItem
                key={item.name}
                title={item.title}
                name={item.name}
                value={userInfo[item.name]}
                type={item.type}
                handleChange={handleInfoChange}
              />
            ))}

            <PreferencesItem
              title="Préférences"
              preferences={preferences}
              userPreferences={userPreferences}
              onChange={handlePreferencesChange}
            />
          </div>

          {isChanged && <FormSubmit txt="Mettre à jour" />}
        </form>
      )}
    </div>
  );
};

export default Info;
