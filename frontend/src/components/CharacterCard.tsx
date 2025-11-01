import React from 'react';

type Character = {
  id: number;
  name_cn: string;
  name_en?: string | null;
  image_url?: string;
  element?: string;
  tier?: string;
  weapon_type?: string;
  role?: string;
  description?: string | null;
};

const elementEmoji: Record<string, string> = {
  Pyro: '🔥',
  Hydro: '💧',
  Anemo: '🍃',
  Electro: '⚡',
  Cryo: '❄️',
  Geo: '⛰️',
};

const CharacterCard: React.FC<{ character: Character }> = ({ character }) => {
  const displayName = character.name_cn || character.name_en || 'Unknown';

  return (
    <article className="char-card" role="button" tabIndex={0}>
      <div className="char-art">
        {character.image_url ? (
          <img src={character.image_url} alt={character.name_en || character.name_cn} />
        ) : (
          <div className="art-placeholder">{(character.name_cn || character.name_en || 'U').charAt(0)}</div>
        )}
        <div className="element-badge">{elementEmoji[character.element || ''] ?? '〼'}</div>
      </div>

      <div className="char-meta">
        <div className="char-name">{displayName}</div>
        {character.name_en && <div className="char-subname">{character.name_en}</div>}
        {character.tier && <div className={`tier-badge tier-${character.tier}`}>{character.tier}</div>}
      </div>
    </article>
  );
};

export default CharacterCard;
