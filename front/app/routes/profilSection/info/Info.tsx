import React, { useState } from 'react';
import FormSubmit from '~/components/main/button/FormSubmit/FormSubmit';
interface InfoItemProps {
  title: string;
  name: string;
  value: string | number;
  type: string;
  handleChange: (e: React.ChangeEvent<HTMLInputElement>) => void;
}

const InfoItem: React.FC<InfoItemProps> = ({ title, name, value, type, handleChange }) => {
  const predefinedPreferences = ['Fumeur', 'Bavard', 'Calme', 'Amical', 'Discret'];

  // Vérifie si c'est le champ préférences
  if (name === 'preferences') {
    const selectedValues = typeof value === 'string' ? value.split(', ') : [];

    const handlePreferenceToggle = (preference: string) => {
      const updatedPreferences = selectedValues.includes(preference)
        ? selectedValues.filter((item) => item !== preference) // Retirer si déjà sélectionné
        : [...selectedValues, preference]; // Ajouter sinon

      // Simuler un event pour le `handleChange`
      handleChange({
        target: { name, value: updatedPreferences.join(', ') }
      } as React.ChangeEvent<HTMLInputElement>);
    };

    return (
      <div className="info__nom-item">
        <div className="info__nom-item-content">
          <div className="info__nom-item-title">
            <p>{title}</p>
          </div>
          <div className="info__nom-item-value flex flex-wrap gap-2">
            {predefinedPreferences.map((pref) => (
              <button
                key={pref}
                type="button"
                className={`px-3 py-1 rounded-full border ${
                  selectedValues.includes(pref) ? 'bg-[var(--maincolor-dark)] text-white' : 'bg-white text-[var(--maincolor-dark)]'
                }`}
                onClick={() => handlePreferenceToggle(pref)}
              >
                {pref}
              </button>
            ))}
          </div>
          <input type="hidden" name={name} value={value} onChange={handleChange} />
        </div>
      </div>
    );
  }

  return (
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
};
const Info = () => {
  interface UserInfo {
    fullName: string;
    birthDate: string;
    mobile: string;
    email: string;
    preferences: string;
  }
  const [userInfo, setUserInfo] = useState<UserInfo>({
    fullName: 'Gauthier Dudek',
    birthDate: '1998-01-01',
    mobile: '+33 6 84 91 09 14',
    email: 'dudek.gauthier@gmail.com',
    preferences: 'Fumeur Bavard'
  });

  const [isChanged, setIsChanged] = useState(false);

  const handleChange = (e: React.ChangeEvent<HTMLInputElement> | React.ChangeEvent<HTMLSelectElement>) => {
    const { name, value } = e.target;
    setUserInfo((prevState) => ({
      ...prevState,
      [name]: value
    }));
    setIsChanged(true);
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    // Save changes logic here
    setIsChanged(false);
  };

  const infoItems: { title: string; name: keyof UserInfo; type: string }[] = [
    { title: 'Nom complet', name: 'fullName', type: 'text' },
    { title: 'Date de naissance', name: 'birthDate', type: 'date' },
    { title: 'Mobile', name: 'mobile', type: 'text' },
    { title: 'Email', name: 'email', type: 'email' },
    { title: 'Préférences', name: 'preferences', type: 'text' }
  ];

  return (
    <div>
      <div className="info">
        <h2>Informations personnelles</h2>
        <div className="info__user">
          <div className="info__user-img">
            <img src="#" alt="" />
          </div>
        </div>
        <form onSubmit={handleSubmit}>
          <div className="info__nom-content">
            {infoItems.map((item) => (
              <InfoItem
                key={item.name}
                title={item.title}
                name={item.name}
                value={userInfo[item.name] as string | number}
                type={item.type}
                handleChange={handleChange}
              />
            ))}
          </div>
          {isChanged && (
            <FormSubmit txt="Mettre à jour" />
          )}
        </form>
      </div>
    </div>
  );
};

export default Info;
