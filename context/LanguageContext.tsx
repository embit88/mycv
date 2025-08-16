'use client';

import React, { createContext, useContext, useEffect, useState } from "react";
import { useRouter } from "next/navigation";
import i18nConfig from "@/i18nConfig";

interface LanguageContextProps {
    translations: { [key: string]: string };
    loading: boolean;
    currentLocale: string;
    defaultLocale: string;
}

const LanguageContext = createContext<LanguageContextProps>({
    translations: {},
    loading: true,
    currentLocale: '',
    defaultLocale: '',
});

export const LanguageProvider: React.FC<{ children: React.ReactNode,
    locale: string,
    itemTranslations: { [key: string]: string },
}> = ({ children, locale, itemTranslations }) => {
    const [currentLocale] = useState<string>(locale);
    const [defaultLocale] = useState<string>(i18nConfig.defaultLocale);
    const [translations, setTranslations] = useState<{ [key: string]: string }>({});
    const [loading, setLoading] = useState(true);

    const router = useRouter();

    useEffect(() => {
        const fetchData = async () => {
            try {

                if (itemTranslations) {
                    setTranslations(itemTranslations);
                }

                setLoading(false);
            } catch (error) {
                console.error('Error fetching data:', error);
                setLoading(false);
            }
        };

        fetchData().then();
    }, [router]);

    return (
        <LanguageContext.Provider value={{ translations, loading, currentLocale, defaultLocale }}>
            {children}
        </LanguageContext.Provider>
    );
};

export const useLanguageContext = () => useContext(LanguageContext);
