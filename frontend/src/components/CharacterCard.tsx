import React from 'react';

type Character = {
  id: number;
  name: string;
  image?: string;
  element?: string;
  tier?: string;
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
  return (
    <article className="char-card" role="button" tabIndex={0}>
      <div className="char-art">
        {character.image ? (
          <img src={character.image} alt={character.name} />
        ) : (
          <div className="art-placeholder">{character.name.charAt(0)}</div>
        )}
        <div className="element-badge">{elementEmoji[character.element || ''] ?? '〼'}</div>
      </div>

      <div className="char-meta">
        <div className="char-name">{character.name}</div>
        {character.tier && <div className={`tier-badge tier-${character.tier}`}>{character.tier}</div>}
      </div>
    </article>
  );
};

export default CharacterCard;
