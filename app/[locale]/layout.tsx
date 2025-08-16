import React from "react";
import { notFound } from 'next/navigation';
import appConfig from "@/appConfig";

export default async function RootNextLayout({children, params}: { children: React.ReactNode; params: Promise<{ locale: string }> }) {
    const locale = (await params).locale;

    if (!appConfig.locales.includes(locale)) {
        notFound();
    }

    return (
        <>
            {children}
        </>
    );
}
