'use client';

import React, { createContext, useContext } from "react";

const TranslationsContext = createContext<Record<string, string>>({});

export const TranslationsProvider = ({ translations, children }: { translations: Record<string, string>; children: React.ReactNode }) => (
    <TranslationsContext.Provider value={translations}>{children}</TranslationsContext.Provider>
);

export const useTranslations = () => useContext(TranslationsContext);
