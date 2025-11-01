import React, { useEffect, useState } from 'react';
import CharacterCard from './CharacterCard';
import type { Filters } from '../App';

type Character = {
  id: number;
  name: string;
  image?: string;
  element?: string;
  tier?: string;
  role?: string;
  weapon?: string;
};

const CharacterGrid: React.FC<{ filters: Filters; searchTerm: string }> = ({ filters, searchTerm }) => {
  const [characters, setCharacters] = useState<Character[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    let mounted = true;
    fetch('/api/characters')
      .then(res => {
        if (!res.ok) throw new Error('Network response not ok');
        return res.json();
      })
      .then((data: Character[]) => {
        if (mounted) {
          setCharacters(data);
          setLoading(false);
        }
      })
      .catch(() => {
        // Fallback placeholder data so UI still renders in dev
        if (mounted) {
          setCharacters([
            { id: 1, name: '魈', element: 'Anemo', tier: 'S', weapon: 'Polearm', role: 'DPS', image: '' },
            { id: 2, name: '楓原萬葉', element: 'Anemo', tier: 'A', weapon: 'Sword', role: 'Support', image: '' },
            { id: 3, name: '晴', element: 'Electro', tier: 'S', weapon: 'Sword', role: 'DPS', image: '' },
          ]);
          setLoading(false);
        }
      });

    return () => {
      mounted = false;
    };
  }, []);

  function applyFilters(list: Character[]) {
    return list.filter(c => {
      if (filters.tier && c.tier !== filters.tier) return false;

      if (filters.attributes.length) {
        // all attributes are OR'd: if any attribute is present, pass
        const matchesAttr = filters.attributes.every(attr => {
          // match by element, weapon or role
          return c.element === attr || c.weapon === attr || c.role === attr;
        });
        if (!matchesAttr) return false;
      }

      if (searchTerm.trim()) {
        const q = searchTerm.toLowerCase();
        if (!c.name.toLowerCase().includes(q)) return false;
      }

      return true;
    });
  }

  const visible = applyFilters(characters);

  return (
    <section className="grid-wrap">
      {loading ? (
        <div className="loading">載入中...</div>
      ) : (
        <div className="char-grid">
          {visible.map(char => (
            <CharacterCard key={char.id} character={char} />
          ))}
        </div>
      )}

      {!loading && visible.length === 0 && <div className="empty">找不到符合的角色</div>}
    </section>
  );
};

export default CharacterGrid;
