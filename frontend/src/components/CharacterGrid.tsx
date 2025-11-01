import React, { useEffect, useState } from 'react';
import CharacterCard from './CharacterCard';
import type { Filters } from '../App';

type Character = {
  id: number;
  name_cn: string;
  name_en?: string | null;
  image_url?: string;
  element?: string;
  tier?: string;
  role?: string;
  weapon_type?: string;
  description?: string | null;
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
            { id: 1, name_cn: '魈', name_en: 'Xiao', element: 'Anemo', tier: 'S', weapon_type: 'Polearm', role: 'DPS', image_url: '' },
            { id: 2, name_cn: '楓原萬葉', name_en: 'Kaedehara Kazuha', element: 'Anemo', tier: 'A', weapon_type: 'Sword', role: 'Support', image_url: '' },
            { id: 3, name_cn: '晴', name_en: 'Sangonomiya Kokomi', element: 'Hydro', tier: 'S', weapon_type: 'Catalyst', role: 'Healer', image_url: '' },
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
        // attributes are treated as OR across element, weapon_type, or role
        const matchesAttr = filters.attributes.every(attr => {
          return c.element === attr || c.weapon_type === attr || c.role === attr;
        });
        if (!matchesAttr) return false;
      }

      if (searchTerm.trim()) {
        const q = searchTerm.toLowerCase();
        const name = ((c.name_cn || '') + ' ' + (c.name_en || '')).toLowerCase();
        if (!name.includes(q)) return false;
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
