import React from 'react';
import {getTranslations} from "@/utils/functions";
import appConfig from "@/appConfig";
import Footer from "@/components/ui/Footer";
import LanguageSelect from "@/components/ui/LanguageSelect";

export async function generateMetadata({ params }: { params: Promise<{ locale: string }> }) {
    const translation = await getTranslations((await params).locale);

    return {
        title: translation.title.impressum,
        description: translation.title.impressum,
    };
}

export default async function Impressum({params}: { params: Promise<{ locale: string }> }) {
    const translation = await getTranslations((await params).locale);

    return (
        <div className="bg-gray-100 min-h-screen">
            <div className="container mx-auto py-12 px-4">
                <LanguageSelect url="impressum" />
                <h1 className="text-3xl font-bold mb-8 text-center">{translation.title.impressum}</h1>
                <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div className="bg-white shadow-md rounded-xs p-6">
                        <h2 className="text-xl font-semibold mb-4">{translation.legal.title_1}</h2>
                        <p>{translation.legal.text_1}</p>
                    </div>
                    <div className="bg-white shadow-md rounded-xs p-6">
                        <h2 className="text-xl font-semibold mb-4">{translation.legal.title_2}</h2>
                        <p className="mb-2"><a href={`mailto:${appConfig.email}`} className="underline">{appConfig.email}</a></p>
                        <p><a href={`tel:${appConfig.phone}`} className="underline">{appConfig.phone}</a></p>
                    </div>
                    <div className="bg-white shadow-md rounded-xs p-6 md:col-span-2">
                        <h2 className="text-xl font-semibold mb-4">{translation.legal.title_3}</h2>
                        <p>
                            {translation.legal.text_3}
                        </p>
                    </div>
                    <div className="bg-white shadow-md rounded-xs p-6 md:col-span-2">
                        <h2 className="text-xl font-semibold mb-4">{translation.legal.title_4}</h2>
                        <p>{translation.legal.text_4}</p>
                    </div>
                </div>
            </div>

            <Footer locale={(await params).locale} />
        </div>
    );
}
